<?php

namespace App\Entities\Blog;

use App\Entities\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    public const TYPE_POST = 'post';
    public const TYPE_EXHIBITION = 'exhibition';

    protected $guarded = ['id'];

    protected $casts = [
        'images' => 'array',
    ];

    protected $perPage = 12;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag_post', 'post_id', 'tag_id');
    }

    public function attachTags(array $tags)
    {
        $this->tags()->detach();

        if (! empty(array_filter($tags))) {
            $this->tags()->attach($tags);
        }
    }

    public static function types(): array
    {
        return [
            static::TYPE_EXHIBITION => 'выставка',
            static::TYPE_POST => 'новость',
        ];
    }

    public function scopeOnlyPosts(Builder $query)
    {
        return $query->where('type', static::TYPE_POST);
    }

    public function scopeOnlyExhibitions(Builder $query)
    {
        return $query->where('type', static::TYPE_EXHIBITION);
    }

    public function newImg(?UploadedFile $file)
    {
        if (! empty($file)) {
            Storage::delete(str_replace('/storage', '', $this->img));
            return '/storage/' . $file->store('posts/main');
        }
    }
}
