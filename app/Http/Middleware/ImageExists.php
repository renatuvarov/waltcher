<?php

namespace App\Http\Middleware;

use App\Entities\Common\Gallery;
use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImageExists
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->exception instanceof NotFoundHttpException) {
            throw new HttpResponseException(response()->json(Gallery::find($request->gallery)->images, 404));
        }

        return $response;
    }
}
