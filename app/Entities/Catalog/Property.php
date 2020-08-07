<?php

namespace App\Entities\Catalog;

use App\Entities\Model;

/**
 * Class Property
 * @package App\Entities\Catalog
 *
 * @property integer $id
 * @property string $name_en
 * @property string $name_ru
 * @property string $measure_ru
 * @property string $measure_en
 */
class Property extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $perPage = 30;

    public function machines()
    {
        return $this->belongsToMany(Machine::class);
    }
}
