@extends('layouts.admin')

@section('title')
    <title>Всё оборудование</title>
@endsection

@section('content')
    <div class="container text-center">
        <h2 class="h2 mb-5 display-4">Всё оборудование</h2>
        <a href="{{route('admin.machines.create')}}" class="btn btn-success d-block w-25 m-auto">Добавить</a>
        @if($machines->isNotEmpty())
            <table class="table table-bordered table-hover mt-5">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Категории</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($machines as $machine)
                    <tr>
                        <td class="align-middle">{{$machine->id}}</td>
                        <td class="align-middle">{{$machine->name}}</td>
                        <td class="align-middle">
                            @if($machine->tags->isNotEmpty())
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Категории
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        @foreach($machine->tags as $tag)
                                            <li class="dropdown-item">{{ $tag->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                ---
                            @endif
                        </td>
                        <td class="align-middle">
                            <a class="btn btn-info" href="{{ route('admin.machines.edit', ['machine' => $machine->slug]) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button data-destroy="{{ route('admin.machines.destroy', ['machine' => $machine->slug]) }}" type="button" class="btn btn-danger btn-destroy">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-5">Пока оборудования нет.</p>
        @endif
        {{ $machines->links() }}
    </div>
    <div class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удалить</h4>
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

@include('parts.admin.open-modal')
