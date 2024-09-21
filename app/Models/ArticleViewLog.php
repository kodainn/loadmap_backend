<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleViewLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'view_user_id'
    ];
}
