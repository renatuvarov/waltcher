@extends('layouts.admin')

@section('title')
    <title>Редактировать оборудование</title>
@endsection

@section('content')
    <div>
        <h2 class="h2 mb-5 display-4 text-center">Редактировать</h2>
        <form class="add-item-form text-left pb-5" method="post" action="{{ route('admin.machines.update', ['machine' => $machine->slug]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group w-50 ml-auto mr-auto mb-5 d-flex">
                <label for="is_landing" class="form-check-label font-weight-bold">Лэндинг?</label>
                @if(! empty($machine->is_landing) || old('is_landing'))
                    <input type="checkbox" name="is_landing" style="width: 30px; height: 30px; margin-left: 30px;" id="is_landing" checked>
                @else
                    <input type="checkbox" name="is_landing" class="form-control" id="is_landing">
                @endif
                @error('is_landing')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="container w-50 m-auto">
                <div class="form-group required border-bottom pb-5">
                    <label for="name" class="form-label">Наименование</label>
                    <input value="{{ old('name', $machine->name) }}"
                           id="name"
                           type="text"
                           class="form-control  @error('name') is-invalid @enderror"
                           placeholder="Наименование"
                           name="name">
                    @error('name')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group required border-bottom pb-4">
                    <input value="{{ old('short_name', $machine->short_name) }}"
                           type="text"
                           class="form-control  @error('short_name') is-invalid @enderror"
                           placeholder="Короткое наименование"
                           name="short_name">
                    @error('short_name')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group required border-bottom pb-4">
                    <input value="{{ old('short_description', $machine->short_description) }}"
                           type="text"
                           class="form-control  @error('short_description') is-invalid @enderror"
                           placeholder="Короткое описание"
                           name="short_description">
                    @error('short_description')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group border-bottom pb-4">
                    <input value="{{ old('meta_description', $machine->meta_description) }}" type="text" class="form-control  @error('meta_description') is-invalid @enderror" placeholder="SEO описание" name="meta_description">
                    @error('meta_description')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group border-bottom pb-5">
                    <label for="slug-input" class="form-label">Слаг</label>
                    <input value="{{ old('slug', $machine->slug) }}" type="text" id="slug-input" class="form-control @error('slug') is-invalid @enderror" placeholder="Слаг" name="slug">
                    @error('slug')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group required border-bottom pb-5">
                    <label for="img-input" class="form-label">Изображение оборудования</label>
                    <input type="file" class="form-control @error('img') is-invalid @enderror" name="img" id="img-input">
                    @error('img')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                @if($galleries->isNotEmpty())
                    <div class="form-group required border-bottom pb-5">
                        <label for="gallery_id">Галерея</label>
                        <select name="gallery_id" id="gallery_id">
                            @if(empty(old('gallery_id')) && ! $machine->gallery_id)
                                <option value="" selected>---</option>
                            @else
                                <option value="">---</option>
                            @endif
                            @foreach($galleries as $gallery)
                                @if(old('gallery_id') == $gallery->id)
                                    <option value="{{ $gallery->id }}" selected>{{ $gallery->name }}</option>
                                @elseif($machine->gallery_id == $gallery->id)
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
                    <input type="file" class="form-control @error('pdf') is-invalid @enderror" name="pdf" id="pdf">
                    @error('pdf')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                @if( ! is_null($machine->pdf))
                    <div class="d-flex justify-content-between">
                        <div class="form-group w-50 ml-auto mr-auto mb-5 d-flex">
                            <a href="{{ route('admin.machines.pdf', ['machine' => $machine->slug]) }}"
                               class="btn btn-warning">
                                <i class="fas fa-file-pdf"></i>
                                <span>Просмотреть pdf</span>
                            </a>
                        </div>
                        <div class="form-group w-50 ml-auto mr-auto mb-5 d-flex">
                            <label for="remove_pdf" class="form-check-label font-weight-bold">Удалить pdf?</label>
                            <input type="checkbox" name="remove_pdf" class="form-control" id="remove_pdf">
                        </div>
                    </div>
                @endif
            </div>
            <div class="form-group border-bottom pb-5">
                <label for="description" class="form-label d-block text-center required h4">Описание</label>
                <textarea id="description"
                          class="form-control  @error('description') is-invalid @enderror summernote"
                          placeholder="Описание"
                          name="description"
                          data-image-url="{{ route('admin.images.upload') }}"
                          data-image-delete="{{ route('admin.images.delete') }}">{{ old('description') ?: $machine->description }}</textarea>
                @error('description')
                <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group border-bottom pb-5 text-center w-50 ml-auto mr-auto">
                <label for="type-select" class="required">Тип</label>
                <select id='type-select' name="type" class="@error('type') is-invalid @enderror form-control w-25 ml-auto mr-auto">
                    @foreach($types as $typeKey => $typeValue)
                        @if(old('type') === $typeKey)
                            <option selected value="{{ $typeKey }}">{{ $typeValue }}</option>
                        @elseif($machine->type === $typeKey)
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
            <div class="container w-50 m-auto">
                <div class="form-group border-bottom pb-5 text-center">
                    <label for="tags-select">Категории</label>
                    <select id='tags-select' multiple='multiple' name="tags[]" class="@error('tags.*') is-invalid @enderror">
                        @if($machine->tags->isEmpty())
                            <option selected value=""></option>
                        @endif
                        @foreach($tags as $tag)
                            @if(in_array($tag->id, array_column($machine->tags->toArray(), 'id')))
                                <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @else
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('tags.*')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <h6>Параметры</h6>
                @foreach($machine->properties as $propertyNum => $propertyName)
                    <div class="form-row"  data-id="{{ $propertyNum }}">
                        <div class="form-group required col-5">
                            <select class="form-control @error('properties.*.name') is-invalid @enderror" name="properties[{{ $propertyNum }}][name]">
                                @foreach($properties as $property)
                                    @if($property->id === $propertyName->id)
                                        <option selected value="{{ $propertyName->id }}">{{ $propertyName->name }}</option>
                                    @else
                                        <option value="{{ $property->id }}">{{ $property->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('properties.*.name')
                            <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group required col-5 ml-5">
                            <input type="text"
                                   class="form-control js-prop @error('properties.*.value') is-invalid @enderror"
                                   placeholder="Значение"
                                   name="properties[{{ $propertyNum }}][value]"
                                   value="{{ old('properties.*.value', $propertyName->pivot->value) }}">
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
                @endforeach
                <div class="form-group mb-3 mt-3">
                    <button type="button" class="btn btn-success btn-block w-50" id="add">Добавить параметр</button>
                </div>
                @error('properties')
                <small class="form-text text-muted ml-2 border-bottom pb-3" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
                <div class="form-group required">
                    <textarea id="mail" class="form-control  @error('mail') is-invalid @enderror" placeholder="Текст в письме" name="mail" rows="10">{{ old('mail', $machine->mail) }}</textarea>
                    @error('mail')
                    <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                    @enderror
                </div>
                <p class="text-left font-weight-bold mt-3"><span class="text-danger">*</span> - обязательные поля</p>
            </div>
            @if(! empty($machine->images))
                @foreach($machine->images as $image)
                    <input type="hidden" class="old-image" name="images[]" value="{{ $image }}">
                @endforeach
            @endif

            @include('parts.admin.check-image')

            <div class="text-center container">
                <button type="submit" class="btn btn-primary w-50">Сохранить</button>
            </div>
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
    <script src="{{ asset('js/summernote-edit-item.js') }}"></script>
    <script>
        $('#tags-select').multiSelect({
            afterSelect: function () {
                $('#tags-select option[value=""]').removeAttr('selected');
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
            $(this).closest('.form-row').remove();
        });
    </script>
@endpush
