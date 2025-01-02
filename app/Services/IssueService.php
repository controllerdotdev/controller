<?php

namespace App\Services;

use App\Models\Issue;
use App\Models\IssueEvent;
use App\Events\IssueReceived;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Workspace;
use App\Models\Project;
use App\Enums\Issue\Priority;
class IssueService
{
    public function process(Workspace $workspace, Project $project, array $data): Issue
    {
        $exception = $data['exception'];
        $fingerprint = $this->generateFingerprint($exception);

        return DB::transaction(function () use ($fingerprint, $data, $exception, $workspace, $project) {
            // Procura ou cria a issue
            $issue = Issue::where('fingerprint', $fingerprint)
                ->where('project_id', $project->id)
                ->first();

            if (!$issue) {
                $issue = Issue::create([
                    'id' => Str::uuid(),
                    'workspace_id' => $workspace->id,
                    'project_id' => $project->id,
                    'title' => $exception['type'],
                    'message' => $exception['value'],
                    'status' => 'unresolved',
                    'priority' => $this->calculatePriority($data),
                    'platform' => $data['platform'],
                    'environment' => $data['environment'],
                    'release' => $data['release'] ?? null,
                    'transaction' => $data['transaction'] ?? null,
                    'exception_class' => $exception['type'],
                    'exception_file' => $exception['stacktrace']['frames'][0]['filename'] ?? null,
                    'exception_line' => $exception['stacktrace']['frames'][0]['lineno'] ?? null,
                    'stack_trace' => $exception['stacktrace'],
                    'context' => $data['extra'] ?? null,
                    'request_data' => $data['request'] ?? null,
                    'tags' => $data['tags'] ?? null,
                    'first_seen_at' => now(),
                    'last_seen_at' => now(),
                    'fingerprint' => $fingerprint,
                    'events_count' => 1,
                    'has_seen' => false,
                ]);
            }

            // Cria o evento para cada ocorrência
            IssueEvent::create([
                'id' => Str::uuid(),
                'issue_id' => $issue->id,
                'environment' => $data['environment'],
                'release' => $data['release'] ?? null,
                'user_data' => $data['user'] ?? null,
                'request_data' => $data['request'] ?? null,
                'context' => $data['extra'] ?? null,
                'tags' => $data['tags'] ?? null,
            ]);

            if ($issue->wasRecentlyCreated === false) {
                // Atualiza contadores se a issue já existia
                $issue->increment('events_count');
                $issue->update(['last_seen_at' => now()]);
            }

            // Dispara evento
            event(new IssueReceived($issue, $issue->wasRecentlyCreated));

            return $issue;
        });
    }

    private function generateFingerprint(array $exception): string
    {
        // Cria um identificador único baseado nas características do erro
        $components = [
            $exception['type'],
            $exception['stacktrace']['frames'][0]['filename'] ?? '',
            $exception['stacktrace']['frames'][0]['lineno'] ?? '',
            $exception['stacktrace']['frames'][0]['function'] ?? '',
        ];

        return md5(implode(':', $components));
    }

    private function calculatePriority(array $data): string
    {
        if ($data['environment'] === 'production') {
            if (str_contains(strtolower($data['exception']['type']), 'fatal')) {
                return Priority::CRITICAL->value;
            }
            return Priority::HIGH->value;
        }

        if ($data['environment'] === 'staging') {
            return Priority::MEDIUM->value;
        }

        return Priority::LOW->value;
    }

    public function markAsSeen(Issue $issue): void
    {
        $issue->update(['has_seen' => true]);
    }

    public function resolve(Issue $issue): void
    {
        $issue->update(['status' => 'resolved']);
    }

    public function ignore(Issue $issue): void
    {
        $issue->update(['status' => 'ignored']);
    }

    public function reopen(Issue $issue): void
    {
        $issue->update([
            'status' => 'unresolved',
            'last_seen_at' => now()
        ]);
    }

    public function updatePriority(Issue $issue, string $priority): void
    {
        // Validação usando o enum
        if (!in_array($priority, array_column(Priority::cases(), 'value'))) {
            throw new \InvalidArgumentException('Invalid priority level');
        }

        $issue->update(['priority' => $priority]);
    }
}
