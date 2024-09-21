<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\UserAdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAd extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon_path',
        'header_image_path',
        'creating_user_id'
    ];
}
