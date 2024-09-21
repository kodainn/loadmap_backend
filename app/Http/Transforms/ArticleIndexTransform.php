<?php

declare(strict_types=1);

namespace App\Http\Transforms;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ArticleIndexTransform implements Transform
{
    public static function modelToArray(Model $model): array
    {
        return [
            'id'              => (int)    $model->id,
            'title'           => (string) $model->title,
            'created_date_jp' => (string) $model->created_date_jp,
            'user'            => (array)  UserIndexTransform::modelToArray($model->user),
            'tags'            => (array)  TagTransform::collectionToArray($model->tags),
            'likes_count'     => (int)    $model->likes_count
        ];
    }

    public static function collectionToArray(Collection $collection): array
    {
        $transforms = [];
        foreach($collection as $value) {
            $transforms[] = ArticleIndexTransform::modelToArray($value);
        }

        return $transforms;
    }
}
