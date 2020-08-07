@extends('layouts.admin')

@section('title')
    <title>Новый пост</title>
@endsection

@section('content')
    <div class="pt-5 pb-5">
        <h2 class="display-4 text-center mb-5">Новый пост (выставка)</h2>
        <form action="{{ route('admin.blog.posts.store') }}" method="post" class="add-item-form mb-5" enctype="multipart/form-data">
            @csrf
            <div class="form-group w-50 ml-auto mr-auto mb-5 text-left d-flex">
                <label for="exh" class="form-check-label font-weight-bold">Выставка?</label>
                <input type="checkbox" name="type" style="width: 30px; height: 30px; margin-left: 30px;" id="exh">
                @error('type')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group w-50 ml-auto mr-auto mb-5">
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="заголовок">
                @error('title')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group required border-bottom pb-4">
                <input value="{{ old('short_description') }}" type="text" class="form-control  @error('short_description') is-invalid @enderror" placeholder="Короткое описание" name="short_description">
                @error('short_description')
                <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group border-bottom pb-4">
                <input value="{{ old('meta_description') }}" type="text" class="form-control  @error('meta_description') is-invalid @enderror" placeholder="SEO описание" name="meta_description">
                @error('meta_description')
                <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group w-50 ml-auto mr-auto mb-5">
                <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="слаг">
                @error('slug')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group required border-bottom pb-5">
                <input type="file" class="form-control @error('img') is-invalid @enderror" name="img">
                @error('img')
                <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group w-25 ml-auto mr-auto mb-5 text-center">
                <label for="tags-select" class="label h4">Тэги</label>
                <select name="tags[]" multiple class="form-control" id="tags-select">
                    <option value="" disabled @if(empty(old('tags'))) selected @endif class="empty-value">не выбрано</option>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}" @if(! empty(old('tags')) && in_array($tag->id, old('tags'))) selected @endif>{{$tag->name}}</option>
                    @endforeach
                </select>
                @error('tags')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <textarea class="summernote"
                      name="content"
                      data-image-url="{{ route('admin.blog.images.upload') }}"
                      cols="130"
                      rows="30"
                      data-image-delete="{{ route('admin.blog.images.delete') }}" placeholder="Контент">{{old('content')}}</textarea><br>
            @error('content')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
            @if($errors->count() > 0 && ! empty(old('images')))
                @foreach(old('images') as $image)
                    <input type="hidden" class="new-image" name="images[]" value="{{ $image }}">
                @endforeach
            @endif
            <button class="btn btn-success btn-block w-25 m-auto" type="submit">Создать</button>
        </form>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/multi-select.dist.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/summernote-tags.js') }}"></script>
    <script src="{{ asset('js/summernote-create-item.js') }}"></script>
    <script>
        $('#tags-select').multiSelect({
            afterSelect: function () {
                $('.ms-selection .empty-value').css({'display': 'none'});
            },
            afterDeselect: function () {
                var values = $('.ms-selection .ms-selected');
                if (values.length === 1 && values.hasClass('empty-value')) {
                    values.css({'display': 'list-item'})
                }
            },
            selectableHeader: "<div class='custom-header'>Выберите тэг</div>",
            selectionHeader: "<div class='custom-header'>Выбранные тэги</div>",
        });
    </script>
@endpush
