<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Enums\Issue\Status;
use App\Enums\Issue\Priority;
use App\Enums\Platform;

class Issue extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'workspace_id',
        'project_id',
        'title',
        'message',
        'status',
        'priority',
        'platform',
        'environment',
        'release',
        'transaction',
        'exception_class',
        'exception_file',
        'exception_line',
        'stack_trace',
        'context',
        'request_data',
        'tags',
        'events_count',
        'has_seen',
        'first_seen_at',
        'last_seen_at',
        'fingerprint',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => Status::class,
            'priority' => Priority::class,
            'platform' => Platform::class,
            'stack_trace' => 'array',
            'context' => 'array',
            'request_data' => 'array',
            'tags' => 'array',
            'has_seen' => 'boolean',
            'first_seen_at' => 'datetime',
            'last_seen_at' => 'datetime',
        ];
    }

    public function issue_events()
    {
        return $this->hasMany(IssueEvent::class);
    }

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
