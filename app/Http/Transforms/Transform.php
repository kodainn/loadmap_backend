<?php

declare(strict_types=1);

namespace App\Http\Transforms;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Transform
{
    /**
     * モデルを配列に変換
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return array
     */
    public static function modelToArray(Model $model): array;

    /**
     * コレクションを配列に変換
     *
     * @param  \Illuminate\Database\Eloquent\Collection $collection
     * @return array
     */
    public static function collectionToArray(Collection $collection): array;
}