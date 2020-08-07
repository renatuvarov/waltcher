@extends('layouts.admin')

@section('title')
    <title>Новая категория</title>
@endsection

@section('content')
    <div class="container">
        <h2 class="display-4 text-center mb-5">Новая категория</h2>
        <form action="{{ route('admin.blog.categories.store') }}" method="post" class="w-50 m-auto pb-5">
            @csrf
            <div class="form-group required">
                <input type="text" name="name_ru" value="{{ old('name_ru') }}" class="form-control" placeholder="Название (русское)">
                @error('name_ru')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="Слаг">
                @error('slug')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <p class="text-left font-weight-bold mt-3"><span class="text-danger">*</span> - обязательные поля</p>
            <button type="submit" class="btn btn-success btn-block w-50">Создать категорию</button>
        </form>
    </div>
@endsection
