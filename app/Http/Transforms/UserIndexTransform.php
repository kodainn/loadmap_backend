<?php

declare(strict_types=1);

namespace App\Http\Transforms;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserIndexTransform implements Transform
{
    public static function modelToArray(Model $model): array
    {
        return [
            'id'         => (int)    $model->id,
            'name'       => (string) $model->name,
            'first_name' => (string) $model->first_name,
            'last_name'  => (string) $model->last_name,
            'icon_path'  => (string) $model->icon_path
        ];
    }

    public static function collectionToArray(Collection $collection): array
    {
        $transforms = [];
        foreach($collection as $value) {
            $transforms[] = UserIndexTransform::modelToArray($value);
        }

        return $transforms;
    }
}
