@extends('layouts.admin')

@section('title')
    <title>Новое оборудование</title>
@endsection

@section('content')
    <div class="text-center">
        <h2 class="h2 mb-5 display-4">Новое оборудование</h2>
        <form class="add-item-form text-left mb-5" method="post" action="{{ route('admin.machines.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group w-50 ml-auto mr-auto mb-5 text-left d-flex">
                <label for="is_landing" class="form-check-label font-weight-bold">Лэндинг?</label>
                <input type="checkbox" name="is_landing" style="width: 30px; height: 30px; margin-left: 30px;" id="is_landing">
                @error('is_landing')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="container w-50 m-auto">
                <div class="form-group required">
                    <input value="{{ old('name') }}"
                           type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Наименование"
                           name="name">
                    @error('name')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group required border-bottom pb-4">
                    <input value="{{ old('short_name') }}"
                           type="text"
                           class="form-control  @error('short_name') is-invalid @enderror"
                           placeholder="Короткое наименование"
                           name="short_name">
                    @error('short_name')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group required border-bottom pb-4">
                    <input value="{{ old('short_description') }}"
                           type="text"
                           class="form-control  @error('short_description') is-invalid @enderror"
                           placeholder="Короткое описание"
                           name="short_description">
                    @error('short_description')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group border-bottom pb-4">
                    <input value="{{ old('meta_description') }}"
                           type="text"
                           class="form-control  @error('meta_description') is-invalid @enderror"
                           placeholder="SEO описание"
                           name="meta_description">
                    @error('meta_description')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group border-bottom pb-3">
                    <input value="{{ old('slug', \Illuminate\Support\Str::slug(old('name'))) }}"
                           type="text"
                           class="form-control @error('slug') is-invalid @enderror"
                           placeholder="Слаг"
                           name="slug">
                    @error('slug')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="h4 d-block text-center required">Описание</label>
                <textarea id="description"
                          class="form-control  @error('description') is-invalid @enderror summernote"
                          name="description"
                          data-image-url="{{ route('admin.images.upload') }}"
                          data-image-delete="{{ route('admin.images.delete') }}">{{ old('description') }}</textarea>
                @error('description')
                <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
            </div>
            <div class="container w-50 m-auto">
                <div class="form-group required border-bottom pb-5">
                    <input type="file" class="form-control @error('img') is-invalid @enderror" name="img">
                    @error('img')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                @if( ! empty($galleries) && $galleries->count() > 0)
                    <div class="form-group border-bottom pb-5">
                        <label for="gallery_id">Галерея</label>
                        <select name="gallery_id" id="gallery_id" class="form-control">
                            @if(empty(old('gallery_id')))
                                <option value="" selected>---</option>
                            @else
                                <option value="">---</option>
                            @endif
                            @foreach($galleries as $gallery)
                                @if(old('gallery_id') == $gallery->id)
                                    <option value="{{ $gallery->id }}" selected>{{ $gallery->name }}</option>
                                @else
                                    <option value="{{ $gallery->id }}">{{ $gallery->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('gallery_id')
                        <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                        @enderror
                    </div>
                @endif
                <div class="form-group border-bottom pb-5">
                    <label for="pdf">PDF</label>
                    <input type="file"
                           class="form-control @error('pdf') is-invalid @enderror"
                           name="pdf"
                           id="pdf">
                    @error('pdf')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group border-bottom pb-5 required">
                    <label for="type-select">Тип</label>
                    <select id='type-select' name="type" class="@error('type') is-invalid @enderror">
                        @if(empty(old('type')))
                            <option selected value="" class="empty-value">---</option>
                        @else
                            <option value="" class="empty-value">---</option>
                        @endif
                        @foreach($types as $typeKey => $typeValue)
                            @if(old('type') === $typeKey)
                                <option selected value="{{ $typeKey }}">{{ $typeValue }}</option>
                            @else
                                <option value="{{ $typeKey }}">{{ $typeValue }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('type')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group border-bottom pb-5">
                    <label for="tags-select">Категории</label>
                    <select id='tags-select' multiple='multiple' name="tags[]" class="@error('tags.*') is-invalid @enderror">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    @error('tags.*')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-row"  data-id="0">
                    <div class="form-group required col-3">
                        <select class="form-control @error('properties.*.name') is-invalid @enderror" name="properties[0][name]">
                            <option disabled selected value="">Параметр</option>
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}">{{ $property->name }}</option>
                            @endforeach
                        </select>
                        @error('properties.*.name')
                        <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group required col-3 ml-5">
                        <input type="text"
                               class="form-control js-prop @error('properties.*.value') is-invalid @enderror"
                               class="form-control js-prop @error('properties.*.value') is-invalid @enderror"
                               placeholder="Значение"
                               name="properties[0][value]"
                               value="{{ old('properties.*.value') }}">
                        @error('properties.*.value')
                        <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col ml-1 del-property-wrapper">
                        <button type="button" class="btn btn-danger del-property">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group border-bottom pb-5 mt-3">
                    <button type="button" class="btn btn-success btn-block w-50" id="add">Добавить параметр</button>
                </div>
                @error('properties')
                <small class="form-text text-muted ml-2 border-bottom pb-3" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
                <div class="form-group required">
                    <textarea id="mail"
                              class="form-control  @error('mail') is-invalid @enderror"
                              placeholder="Текст в письме"
                              name="mail"
                              rows="10">{{ old('mail') }}</textarea>
                    @error('mail')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <p class="text-left font-weight-bold mt-3"><span class="text-danger">*</span> - обязательные поля</p>
                <button type="submit" class="btn btn-primary d-block w-50">Создать</button>
            </div>
            @if($errors->count() > 0 && ! empty(old('images')))
                @foreach(old('images') as $image)
                    <input type="hidden" class="new-image" name="images[]" value="{{ $image }}">
                @endforeach
            @endif
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
                $('#tags-select .empty-value').removeAttr('selected');
            },
            selectableHeader: "<div class='custom-header'>Выберите категорию</div>",
            selectionHeader: "<div class='custom-header'>Выбранные категории</div>",
        });

        $('#add').on('click', function (e) {
            var props = $(e.target).closest('.form-group').prev().clone();
            var id = props.data('id');
            id++;
            props.attr('data-id', id);
            $('select', props)
                .attr('name', 'properties[' + id + '][name]')
                .find('option:selected').removeAttr('selected');
            $('option[disabled]', props).remove();
            $('select', props).prepend('<option disabled selected value="">Параметр</option>');
            $('.js-prop', props).attr('name', 'properties[' + id + '][value]').val('');
            props.insertBefore($(this).closest('.form-group'));
        });

        $('form').on('click', '.del-property',  function () {
            if ($('.form-row').length === 1) {
                return;
            }
            $(this).closest('.form-row').remove();
        });
    </script>
@endpush
