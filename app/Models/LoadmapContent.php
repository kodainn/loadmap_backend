<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoadmapContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'title',
        'description'
    ];

    public function contentResources(): HasMany
    {
        return $this->hasMany(LoadmapContentResource::class);
    }
}
