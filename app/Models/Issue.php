<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Enums\Issue\Status;
use App\Enums\Issue\Priority;
use App\Enums\Issue\Platform;

class Issue extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'workspace_id',
        'project_id',
        'title',
        'description',
        'status',
        'priority',
        'platform',
        'has_seen',
        'last_issue_at',
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
            'has_seen' => 'boolean',
            'last_issue_at' => 'datetime',
        ];
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
