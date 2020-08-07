<?php


namespace App\Traits;


trait UpdatesImagesTrait
{
    public function updateImagesList(array $images, array $forRemoving): array
    {
        $images = array_filter($images, function ($image) use ($forRemoving) {
            return ! in_array($image, $forRemoving);
        });

        $this->manager->delete($forRemoving);

        return $images;
    }
}
