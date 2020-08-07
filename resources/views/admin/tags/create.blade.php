@extends('layouts.admin')

@section('title')
    <title>Новая категория</title>
@endsection

@section('content')
    <div class="container text-center">
        <h2 class="h2 mb-5 display-4">Новая категория</h2>
        <form class="text-left w-50 m-auto" method="post" action="{{ route('admin.tag.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group w-50 ml-auto mr-auto mb-5 text-left d-flex">
                <label for="main" class="form-check-label font-weight-bold">Показывать на главной?</label>
                <input type="checkbox" name="main" style="width: 30px; height: 30px; margin-left: 30px;" id="main" checked>
            </div>
            <div class="form-group required">
                <input value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Наименование" name="name">
                @error('name')
                <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <input value="{{ old('slug') }}" type="text" class="form-control @error('slug') is-invalid @enderror" placeholder="Слаг" name="slug">
                @error('slug')
                <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group required">
                <input value="{{ old('img') }}" type="file" class="form-control @error('img') is-invalid @enderror" name="img">
                @error('img')
                <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
            </div>
            <p class="text-left font-weight-bold mt-3"><span class="text-danger">*</span> - обязательные поля</p>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection
