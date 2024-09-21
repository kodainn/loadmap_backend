<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadmapContentResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'loadmap_content_id',
        'image_path',
        'title',
        'link_url',
        'alt'
    ];
}
