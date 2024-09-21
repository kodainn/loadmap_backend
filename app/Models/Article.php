<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'prerequisite_knowledge',
        'creating_user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creating_user_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(ArticleLike::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ArticleComment::class);
    }

    public function viewLogs(): HasMany
    {
        return $this->hasMany(ArticleViewLog::class);
    }

    public function loadmapContents(): HasMany
    {
        return $this->hasMany(LoadmapContent::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function indexSelect(): Builder
    {
        return $this->select(DB::raw("
                articles.id,
                title,
                creating_user_id,
                DATE_FORMAT(articles.created_at, '%Y年%m月%d日') as created_date_jp"))
            ->with(['user', 'tags'])
            ->withCount('likes');
    }
}
