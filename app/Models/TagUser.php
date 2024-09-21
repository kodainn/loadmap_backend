<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagUser extends Model
{
    use HasFactory;

    protected $table = 'tag_user';

    protected $fillable = [
        'tag_id',
        'user_id'
    ];
}
