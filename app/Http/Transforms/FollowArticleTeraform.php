<?php

declare(strict_types=1);

namespace App\Http\Transforms;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FollowArticleTeraform
{
    public static function modelToArray(Model $model): array
    {
        return [
            'id'       => (int)    $model->id,
            'name'     => (string) $model->name,
            'articles' => (array)  ArticleIndexTransform::collectionToArray($model->articles)
        ];
    }

    public static function collectionToArray(Collection $collection): array
    {
        $transforms = [];
        foreach($collection as $value)  {
            $transforms[] = RecommendedArticleTransform::modelToArray($value);
        }

        return $transforms;
    }
}