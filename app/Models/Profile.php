<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\ProfileScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope(new ProfileScope);
    }

    protected $fillable = [
        'user_id',
        'self_introduction',
        'github_url',
        'x_url'
    ];
}
