@extends('layouts.admin')

@section('title')
    <title>Все галереи</title>
@endsection

@section('content')
    <div class="container text-center">
        <h2 class="h2 mb-5 display-4">Все галереи</h2>
        <a href="{{route('admin.common.galleries.create')}}" class="btn btn-success d-block w-25 m-auto">Добавить</a>
        @if(! empty($galleries) && $galleries->count() > 0)
            <table class="table table-bordered table-hover mt-5">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($galleries as $gallery)
                    <tr>
                        <td class="align-middle">{{$gallery->id}}</td>
                        <td class="align-middle">{{$gallery->name}}</td>
                        <td class="align-middle">
                            <a class="btn btn-warning" href="{{ route('admin.common.galleries.show', ['gallery' => $gallery->id]) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-info" href="{{ route('admin.common.galleries.edit', ['gallery' => $gallery->id]) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button data-destroy="{{ route('admin.common.galleries.destroy', ['gallery' => $gallery->id]) }}" type="button" class="btn btn-danger btn-destroy">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-5">Пока галерей нет.</p>
        @endif
        {{ $galleries->links() }}
    </div>
    <div class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удалить галерею</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Продолжить?</p>
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
