<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IssueEvent extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'issue_id',
        'environment',
        'release',
        'user_data',
        'request_data',
        'context',
        'tags',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'user_data' => 'array',
            'request_data' => 'array',
            'context' => 'array',
            'tags' => 'array',
        ];
    }

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
