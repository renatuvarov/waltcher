<?php

namespace App\Entities\Common;

use App\Entities\Catalog\Machine;
use App\Entities\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Gallery extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];

    protected $casts = [
        'images' => 'array',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function withMachine(?Machine $machine)
    {
        is_null($machine) ? $this->machine()->dissociate()
                          : $this->machine()->associate($machine);
        $this->save();
    }

    private function handleGalleryChanges(string $path, callable $handler)
    {
        $images = array_values($this->images);
        $index = array_search($path, $images);

        if ($index === false) {
            throw new NotFoundHttpException('Изображение ' . $path . ' не найдено');
        }

        $handler($images, $index);

        return $this;
    }

    public function photoUp(string $path): self
    {
        return $this->handleGalleryChanges($path, function ($images, $index) use ($path) {
            if ($index > 0) {
                $previous = $images[$index - 1];
                $images[$index - 1] = $path;
                $images[$index] = $previous;

                $this->update(['images' => array_values($images)]);
            }
        });
    }

    public function photoDown(string $path)
    {
        return $this->handleGalleryChanges($path, function ($images, $index) use ($path) {
            if ($index < (count($images) - 1)) {
                $next = $images[$index + 1];
                $images[$index + 1] = $path;
                $images[$index] = $next;

                $this->update([
                    'images' => array_values($images),
                ]);
            }
        });
    }

    public function removePhoto(string $path): self
    {
        return $this->handleGalleryChanges($path, function ($images, $index) use ($path) {
            $this->update([
                'images' => array_values(array_filter(array_values($this->images), function ($image) use ($path) {
                    return $image !== $path;
                })),
            ]);
        });
    }
}
