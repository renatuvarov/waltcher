@extends('layouts.admin')

@section('title')
    <title>{{ $gallery->name }}</title>
@endsection

@section('content')
    <div class="container text-center">
        <h2 class="h2 mb-5 display-4">{{ $gallery->name }}</h2>
        <a href="{{route('admin.common.galleries.edit', ['gallery' => $gallery->id])}}" class="btn btn-success d-block w-25 m-auto">Редактировать</a>
        <table class="table table-bordered table-hover mt-5 w-50 ml-auto mr-auto js-photos-list" data-gallery="{{ $gallery->id }}">
            <tbody>
            @foreach($gallery->images as $image)
                <tr class="js-photo" data-path="{{ $image }}">
                    <td class="align-middle" style="width: 400px;"><img src="{{ $image }}" alt="{{ $image }}" class="img-fluid"></td>
                    <td class="align-middle">
                        <div class="control-btns flex-column">
                            <button class="btn btn-info mb-3 js-btn-pos"
                                    type="button"
                                    data-url="{{ route('admin.common.photo.up') }}"
                                    style="width: 100px; height: 100px;">
                                <i class="fa fa-arrow-up fa-5x"></i>
                            </button>
                            <button class="btn btn-info mb-3 js-btn-pos"
                                    type="button"
                                    data-url="{{ route('admin.common.photo.down') }}"
                                    style="width: 100px; height: 100px;">
                                <i class="fa fa-arrow-down fa-5x"></i>
                            </button>
                            <button data-url="{{ route('admin.common.photo.remove') }}"
                                    type="button" class="btn btn-danger btn-destroy js-btn-remove"
                                    style="width: 100px; height: 100px;">
                                <i class="fa fa-trash fa-4x"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="gallery-layout">

    </div>
@endsection

@push('css')
    <style>
        .gallery-layout {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.61);
            z-index: 1000000;
            display: none;
        }
    </style>
@endpush

@push('js')
    <script>
        var layout = $('.gallery-layout');
        var $list = $('.js-photos-list');

        function changeGallery(method, el) {
            layout.show();
            $.ajax({
                url: el.data('url'),
                type: method,
                data: {gallery: $list.data('gallery'), path: el.closest('.js-photo').data('path')},
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function (response) {
                    updateTable(response);
                },
                error: function (error) {
                    if (error.status === 404 && error.responseJSON instanceof Array) {
                        console.error('Изображение ' + el.closest('.js-photo').data('path') + ' не найдено.');
                        updateTable(error.responseJSON);
                    } else {
                        console.error(error.responseJSON.message);
                    }
                }
            }).done(hideLayout()).fail(hideLayout());
        }

        function hideLayout() {
            layout.hide();
        }

        function updateTable(images) {
            var tbody = $('<tbody>');
            images.map(function (image) {
                tbody.append($('tr[data-path="' + image + '"').get(0));
            });
            var oldBody = $('tbody');
            tbody.insertBefore(oldBody);
            oldBody.remove();
            layout.hide();
        }

        $list.on('click', '.js-btn-pos', function () {
            changeGallery('PATCH', $(this));
        });

        $list.on('click', '.js-btn-remove', function () {
            if ($('.js-photos-list .js-photo').length <= 1) {
                return;
            }

            changeGallery('DELETE', $(this));
        });
    </script>
@endpush
