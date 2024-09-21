<?php

declare(strict_types=1);

namespace App\Http\Transforms;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TagTransform implements Transform
{
    public static function modelToArray(Model $model): array
    {
        return [
            'id'   => (int)    $model->id,
            'name' => (string) $model->name
        ];
    }

    public static function collectionToArray(Collection $collection): array
    {
        $transforms = [];
        foreach($collection as $value) {
            $transforms[] = TagTransform::modelToArray($value);
        }

        return $transforms;
    }
}
