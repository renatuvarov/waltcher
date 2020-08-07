<?php

namespace App\Entities\Catalog;

use App\Dto\Catalog\Machines\Properties;
use App\Dto\Catalog\Machines\Tags;
use App\Entities\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Entities\Common\Gallery;

/**
 * Class Machine
 * @package App\Entities\Catalog
 *
 * @property integer $id
 * @property string $name_en
 * @property string $name_ru
 * @property string $description_en
 * @property string $description_ru
 * @property string $mail_ru
 * @property string $mail_en
 * @property string $slug
 * @property string $img
 * @property array $images
 */
class Machine extends Model
{
    public const TYPE_PROCESSING = 'processing';
    public const TYPE_PACKING = 'packing';

    public $timestamps = false;
    protected $guarded = ['id'];

    protected $casts = [
        'images' => 'array',
    ];

    protected $perPage = 12;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function getTypes(): array
    {
        return [
            self::TYPE_PROCESSING => 'производство',
            self::TYPE_PACKING => 'упаковка',
        ];
    }

	public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot('value');
    }

    public function setTags(Tags $tags): void
    {
        $this->tags()->sync($tags->getTags());
    }

    public function setProperties(Properties $properties): void
    {
        $this->properties()->sync($properties->get());
    }

    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeGetMachines($query, string $type = '')
    {
        if ( ! empty($type)) {
            $query->type($type);
        }

        return $query->orderBy('id');
    }
}
