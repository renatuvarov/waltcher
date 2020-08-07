<?php

namespace App\Repositories;

use App\Entities\Common\Gallery;

class GalleryRepository
{
    /**
     * @param int $id
     * @return Gallery
     */
    public function findByIdOrFail(int $id): Gallery
    {
        return Gallery::query()->findOrFail($id);
    }
}
