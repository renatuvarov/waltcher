@extends('layouts.admin')

@section('title')
    <title>Все параметры</title>
@endsection

@section('content')
    <div class="container text-center">
        <h2 class="h2 mb-5 display-4">Все параметры</h2>
        <a href="{{route('admin.properties.create')}}" class="btn btn-success d-block w-25 m-auto">Добавить</a>
        @if($properties->isNotEmpty())
            <table class="table table-bordered table-hover mt-5">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($properties as $property)
                    <tr>
                        <td class="align-middle">{{$property->id}}</td>
                        <td class="align-middle">{{$property->name}}</td>
                        <td class="align-middle">
                            <a class="btn btn-info" href="{{ route('admin.properties.edit', ['property' => $property->id]) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button data-destroy="{{ route('admin.properties.destroy', ['property' => $property->id]) }}" type="button" class="btn btn-danger btn-destroy">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-5">Пока параметров нет.</p>
        @endif
        {{ $properties->links() }}
    </div>
    <div class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удалить параметр</h4>
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
