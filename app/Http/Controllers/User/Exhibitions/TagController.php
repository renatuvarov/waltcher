<?php

namespace App\Http\Controllers\User\Exhibitions;

use App\Entities\Blog\Tag;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->onlyExhibitions()->paginate();
        return $this->getView('user.exhibitions.tags.show', compact('tag', 'posts'));
    }
}
