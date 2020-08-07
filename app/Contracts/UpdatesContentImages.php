<?php


namespace App\Contracts;


interface UpdatesContentImages
{
    public function updateImagesList(array $images, array $forRemoving): array;
}
