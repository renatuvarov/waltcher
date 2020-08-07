@extends('layouts.admin')

@section('title')
    <title>Редактировать категорию</title>
@endsection

@section('content')
    <div class="container">
        <h2 class="display-4 text-center mb-5">Редактировать категорию</h2>
        <form action="{{ route('admin.blog.categories.update', ['category' => $category->id]) }}" method="post" class="w-50 m-auto pb-5">
            @csrf
            @method('put')
            <div class="form-group">
                <input type="text" name="name_ru" value="{{ old('name_ru', $category->name_ru) }}" class="form-control" placeholder="Название (русское)">
                @error('name_ru')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="name_en" value="{{ old('name_en', $category->name_en) }}" class="form-control" placeholder="Название (английское)">
                @error('name_en')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="form-control" placeholder="Слаг">
                @error('slug')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-success btn-block w-50">Сохранить</button>
        </form>
    </div>
@endsection
