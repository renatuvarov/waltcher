<?php

namespace App\Http\Controllers\User\Catalog;

use App\Entities\Catalog\Tag;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function show(Tag $tag, string $type = '')
    {
        $machines = $tag->machines()->getMachines($type)->paginate();
        return view('user.catalog.tags.show', compact('tag', 'machines'));
    }
}
