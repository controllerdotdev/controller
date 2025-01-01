<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\User\Role;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use App\Observers\WorkspaceObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(WorkspaceObserver::class)]
class Workspace extends Model implements HasMedia
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'logo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [

        ];
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'logo_url'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logos');
    }

    public function getLogoUrlAttribute()
    {
        return $this->hasMedia('logos')
        ? $this->getFirstMediaUrl('logos')
        : "https://api.dicebear.com/7.x/initials/svg?backgroundType=gradientLinear&fontFamily=Helvetica&fontSize=40&seed=url". urlencode($this->name);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->as('membership')
            ->withTimestamps();
    }

    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class);
    }
}
