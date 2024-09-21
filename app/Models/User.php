<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'icon_path',
        'first_name',
        'last_name'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new UserScope);
    }

    public function settingMailNotice(): HasOne
    {
        return $this->hasOne(SettingMailNotice::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function ads(): HasMany
    {
        return $this->hasMany(
            UserAd::class,
            'creating_user_id'
        );
    }

    public function articles(): HasMany
    {
        return $this->hasMany(
            Article::class,
            'creating_user_id'
        );
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function follows(): BelongsToMany
    {
        return $this->BelongsToMany(
            User::class,
            'follow_user',
            'following_user_id',
            'followed_user_id'
        );
    }

    public function followers(): BelongsToMany
    {
        return $this->BelongsToMany(
            User::class,
            'follow_user',
            'followed_user_id',
            'following_user_id'
        );
    }
}
