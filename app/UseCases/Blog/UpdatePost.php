<?php

namespace App\UseCases\Blog;

use App\Contracts\UpdatesContentImages;
use App\Entities\Blog\Post;
use App\Handlers\FileManager;
use App\Traits\UpdatesImagesTrait;
use Illuminate\Support\Str;

class UpdatePost implements UpdatesContentImages
{
    use UpdatesImagesTrait;

    /**
     * @var FileManager
     */
    private $manager;

    public function __construct(FileManager $manager)
    {
        $this->manager = $manager;
    }

    public function action(array $data, Post $post): Post
    {
        $post->attachTags($data['tags'] ?? []);

        $post->update([
            'title' => $en = $data['title'] ?: $post->title,
            'short_description' => $data['short_description'],
            'meta_description' => $data['meta_description'] ?: $post->meta_description,
            'slug' => Str::slug(mb_strtolower($data['slug'])) ?: $post->slug,
            'content' => clean($data['content'], 'youtube'),
            'type' => empty($data['type']) ? Post::TYPE_POST : Post::TYPE_EXHIBITION,
            'img' => $post->newImg($data['img'] ?? null) ?: $post->img,
            'images' => empty(
                $images = $this->updateImagesList($data['images'] ?? [], $data['for_removing'] ?? [])
            ) ? null : $images,
        ]);

        return $post;
    }
}
