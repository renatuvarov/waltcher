@extends('layouts.admin')

@section('title')
    <title>Редактировать тэг</title>
@endsection

@section('content')
    <div class="container">
        <h2 class="display-4 text-center mb-5">Редактировать тэг</h2>
        <form action="{{ route('admin.blog.tags.update', ['tag' => $tag->slug]) }}" method="post" class="w-50 m-auto pb-5">
            @csrf
            @method('put')
            <div class="form-group">
                <input type="text" name="name" value="{{ old('name', $tag->name) }}" class="form-control" placeholder="Название">
                @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="slug" value="{{ old('slug', $tag->slug) }}" class="form-control" placeholder="Слаг">
                @error('slug')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-success btn-block w-50">Сохранить</button>
        </form>
    </div>
@endsection

