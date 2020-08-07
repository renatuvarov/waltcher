@extends('layouts.admin')

@section('title')
    <title>Все категории</title>
@endsection

@section('content')
    <div class="container text-center">
        <h2 class="h2 mb-5 display-4">Категории</h2>
        <a href="{{route('admin.blog.categories.create')}}" class="btn btn-success d-block w-25 m-auto">Добавить</a>
        @if(! empty($categories) && $categories->count() > 0)
            <table class="table table-bordered table-hover mt-5">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Наименование (eng)</th>
                    <th scope="col">Наименование (ru)</th>
                    <th scope="col">Слаг</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="align-middle">{{ $category->id }}</td>
                        <td class="align-middle">{{ $category->name_en }}</td>
                        <td class="align-middle">{{ $category->name_ru }}</td>
                        <td class="align-middle">{{ $category->slug }}</td>
                        <td class="align-middle">
                            <a class="btn btn-info" href="{{ route('admin.blog.categories.edit', ['category' => $category->id]) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button data-destroy="{{ route('admin.blog.categories.destroy', ['category' => $category->id]) }}" type="button" class="btn btn-danger btn-destroy">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-5">Пока категорий нет.</p>
        @endif
        {{ $categories->links() }}
    </div>
    <div class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удалить категорию</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Удаление категории приведет к удалению всех входящих в нее постов.<br>Продолжить?</p>
                    <form action="" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('.btn-destroy').on('click', function () {
            $('.modal').find('form').attr('action', $(this).data('destroy'));
            $('.modal').modal();
        });
    </script>
@endpush
