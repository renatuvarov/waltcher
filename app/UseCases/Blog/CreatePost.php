<?php


namespace App\UseCases\Blog;


use App\Entities\Blog\Post;
use App\Handlers\FileManager;
use Illuminate\Support\Str;

class CreatePost
{
    /**
     * @var FileManager
     */
    private $manager;

    public function __construct(FileManager $manager)
    {
        $this->manager = $manager;
    }

    public function action(array $data): Post
    {
        /** @var Post $post */
        $post = Post::create([
            'title' => $data['title'],
            'short_description' => $data['short_description'],
            'meta_description' => $data['meta_description'] ?: null,
            'slug' => Str::slug(mb_strtolower($data['slug'])) ?: Str::slug(mb_strtolower($data['title'])),
            'content' => clean($data['content'], 'youtube'),
            'images' => empty($data['images']) ? null : $data['images'],
            'type' => empty($data['type']) ? Post::TYPE_POST : Post::TYPE_EXHIBITION,
            'img' => $this->manager->load($data['img'], 'posts/main'),
        ]);

        $post->attachTags($data['tags'] ?? []);

        return $post;
    }
}
