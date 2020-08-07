<?php

namespace App\Http\Controllers\Admin\Common;

use App\Entities\Common\Gallery;
use App\Handlers\FileManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GalleryPhotosController extends Controller
{
    public function photoUp(Request $request)
    {
        $gallery = Gallery::query()->findOrFail($request->gallery);
        return $gallery->photoUp($request->path)->images;
    }

    public function photoDown(Request $request)
    {
        $gallery = Gallery::query()->findOrFail($request->gallery);
        return $gallery->photoDown($request->path)->images;
    }

    public function removePhoto(Request $request, FileManager $manager)
    {
        $gallery = Gallery::query()->findOrFail($request->gallery);
        $gallery->removePhoto($request->path);
        $manager->delete([$request->path]);
        return $gallery->images;
    }
}
