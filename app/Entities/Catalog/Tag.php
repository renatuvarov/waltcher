<?php

namespace App\Entities\Catalog;

use App\Entities\Model;

/**
 * Class Tag
 * @package App\Entities\Catalog
 *
 * @property integer $id
 * @property string $name_en
 * @property string $name_ru
 * @property string $slug
 * @property string $img
 */
class Tag extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    protected $perPage = 30;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function machines()
    {
        return $this->belongsToMany(Machine::class);
    }
}
