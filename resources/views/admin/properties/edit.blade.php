@extends('layouts.admin')

@section('title')
    <title>Редактировать параметр</title>
@endsection

@section('content')
    <div class="container text-center">
        <h2 class="h2 mb-5 display-4">Редактировать параметр</h2>
        <form class="text-left w-50 m-auto" method="post" action="{{ route('admin.properties.update', ['property' => $property->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group required">
                <input value="{{ old('name', $property->name) }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Наименование" name="name">
                @error('name')
                <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
            </div>
            <p class="text-left font-weight-bold mt-3"><span class="text-danger">*</span> - обязательные поля</p>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
@endsection
