<?php

namespace App\Listeners;

use App\Events\IssueReceived;
use App\Notifications\NewIssueNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyIssueReceived implements ShouldQueue
{
    public function handle(IssueReceived $event): void
    {
        if ($event->isNewIssue) {
            // Notifica membros do projeto
            $event->issue->project->members->each(function ($member) use ($event) {
                $member->notify(new NewIssueNotification($event->issue));
            });

            // Se configurado, envia para webhook
            if ($webhook = $event->issue->project->webhook_url) {
                $this->sendWebhook($webhook, $event->issue);
            }
        }
    }

    private function sendWebhook(string $url, Issue $issue): void
    {
        Http::post($url, [
            'event' => 'issue.created',
            'issue' => [
                'id' => $issue->id,
                'title' => $issue->title,
                'environment' => $issue->environment,
                'url' => route('issues.show', $issue->id)
            ]
        ]);
    }
}
