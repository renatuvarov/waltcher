<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Builder;

abstract class Model extends BaseModel
{
    /**
     * Get model with specified slug
     *
     * @param string $slug
     * @return BaseModel
     *
     * @throws ModelNotFoundException
     */
    public static function findBySlugOrFail(string $slug)
    {
        $model = static::query()->whereSlug($slug)->first();

        if (empty($model)) {
            throw new ModelNotFoundException('Model not found by slug = ' . $slug);
        }

        return $model;
    }

    /**
     * Get model with specified slug
     *
     * @param Builder $query
     * @param string $slug
     * @return Builder
     *
     */
    public function scopeWhereSlug(Builder $query, string $slug)
    {
        return $query->where('slug', $slug);
    }
}
