@extends('layouts.admin')

@section('title')
    <title>Новая галерея</title>
@endsection

@section('content')
    <div class="container text-center">
        <h2 class="h2 mb-5 display-4">Новая галерея</h2>
        <form class="text-left w-50 m-auto" method="post" action="{{ route('admin.common.galleries.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group required">
                <input value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Наименование" name="name">
                @error('name')
                <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group required">
                <label for="image_uploads" class="btn btn-info">Выбрать файл (.jpg, .jpeg, .png). Максимальный размер - 1 мегабайт</label>
                <input type="file" multiple accept=".jpg, .jpeg, .png" class="form-control js-file" name="images[]" id="image_uploads" style="opacity: 0; width: 0; height: 0;">
            </div>
            <div class="preview">
                <p>Файлы не выбраны.</p>
            </div>
            <div class="form-group">
                @error('images')
                <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                @error('images.*')
                <small class="form-text text-muted ml-2" style="color: #c82333 !important;">{{$message}}</small>
                @enderror
            </div>
            <p class="text-left font-weight-bold mt-3"><span class="text-danger">*</span> - обязательные поля</p>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection

@push('js')
    <script>
        var input = document.querySelector('.js-file');
        var preview = document.querySelector('.preview');

        input.addEventListener('change', updateImageDisplay);

        var listf = input.files;

        function updateImageDisplay() {
            while(preview.firstChild) {
                preview.removeChild(preview.firstChild);
            }

            var curFiles = input.files;

            if(curFiles.length === 0) {
                var para = document.createElement('p');
                para.textContent = 'Нет выбарнный файлов.';
                preview.appendChild(para);
            } else {
                var list = document.createElement('ul');
                list.classList.add('list-group');
                preview.appendChild(list);
                for(var i = 0; i < curFiles.length; i++) {
                    var listItem = document.createElement('li');
                    listItem.classList.add('list-group-item', 'd-flex', 'p-0');
                    var para = document.createElement('p');
                    para.classList.add('w-75', 'p-3', 'd-flex', 'align-items-center', 'flex-column');
                    if(validFileType(curFiles[i])) {
                        para.textContent = 'Имя файла: ' + curFiles[i].name + ', размер ' + returnFileSize(curFiles[i].size) + '.';
                        if (curFiles[i].size > 1048576) {
                            var br = document.createElement('br');
                            para.appendChild(br);
                            var span = document.createElement('span');
                            span.textContent = 'Превышен максимальный размер файла!';
                            span.style.color = 'red';
                            para.appendChild(span);
                        }
                        var imageWrapper = document.createElement('div');
                        imageWrapper.classList.add('w-25', 'border-right');
                        var image = document.createElement('img');
                        image.classList.add('img-fluid');
                        image.src = window.URL.createObjectURL(curFiles[i]);
                        imageWrapper.appendChild(image);
                        listItem.appendChild(imageWrapper);
                        listItem.appendChild(para);

                    } else {
                        para.textContent = 'Файл ' + curFiles[i].name + ': некорректный формат файла.';
                        listItem.appendChild(para);
                    }

                    list.appendChild(listItem);
                }
            }
        }

        var fileTypes = [
            'image/jpeg',
            'image/pjpeg',
            'image/png'
        ];

        function validFileType(file) {
            for(var i = 0; i < fileTypes.length; i++) {
                if(file.type === fileTypes[i]) {
                    return true;
                }
            }

            return false;
        }

        function returnFileSize(number) {
            if(number < 1024) {
                return number + ' байт';
            } else if(number > 1024 && number < 1048576) {
                return (number/1024).toFixed(1) + ' килобайт';
            } else if(number > 1048576) {
                return (number/1048576).toFixed(1) + ' мегабайт';
            }
        }
    </script>
@endpush
