<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingMailNotice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_site_notice_enable',
        'is_article_like_notice_enable',
        'is_article_comment_notice_enable'
    ];
}
