<div style="width: 75%; margin: 0 auto;">
    {{$post->title_ru}}<br>
    {{$post->title_en}}<br>
    {{$post->slug}}<br>
    {{$post->category->name_ru}}<br>
    {{$post->category->name_en}}<br>
    @if($post->tags->count() > 0)
        tags: <br>
        @foreach($post->tags as $tag)
            - {{$tag->name_ru}}<br>
            - {{$tag->name_en}}<br>
        @endforeach
    @else

    @endif

    {!! $post->content_ru !!} <br>
    {!! $post->content_en !!} <br>
</div>
