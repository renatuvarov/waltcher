@extends('layouts.admin')

@section('title')
    <title>Правки</title>
@endsection

@section('content')
    <div class="text-center">
        <h2 class="h2 mb-5 display-4">Правки</h2>
        <div class="container">
            <div class="row justify-content-around">
                <div class="text-center" style="width: 200px">
                    <div class="card border-dark">
                        <div class="card-header display-5" style="color:#fff; background-color: #343a40; padding: 0">Всего правок</div>
                        <div class="card-body text-dark" style="font-size: 25px; padding: 0">{{ $correctionsCount }}</div>
                    </div>
                </div>
                <div class="text-center" style="width: 200px">
                    <div class="card border-dark">
                        <div class="card-header display-5" style="color:#fff; background-color:#009d00; padding: 0">Новых правок</div>
                        <div class="card-body text-dark" style="font-size: 25px; padding: 0">{{ $correctionsActiveCount }}</div>
                    </div>
                </div>
            </div>
        </div>
        @if(! empty($corrections) && $corrections->count() > 0)
            <table class="table table-bordered table-hover mt-5 js-correction-table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Исправить</th>
                    <th scope="col">Исправить на</th>
                    <th scope="col">Комментарий</th>
                    <th scope="col">Страница</th>
                    <th scope="col">Управление</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Дата изменения</th>
                </tr>
                </thead>
                <tbody>
                @foreach($corrections as $correction)
                    <tr>
                        <td class="align-middle">{{ $correction->id }}</td>
                        <td class="align-middle w-25">{{ $correction->from }}</td>
                        <td class="align-middle w-25">{{ $correction->to }}</td>
                        <td class="align-middle">{{ $correction->comment ?? '---' }}</td>
                        <td class="align-middle"><a href="{{ $correction->url }}" class="btn btn-info">{{ $correction->url }}</a></td>
                        <td class="align-middle">
                            @if($correction->active)
                                <a class="btn btn-warning js-correction-viewed" href="{{ route('admin.corrections.edit', ['correction' => $correction->id]) }}">
                                    <i class="fas fa-angry"></i>
                                </a>
                            @else
                                <button disabled type="button" class="btn btn-outline-success">
                                    <i class="fas fa-check"></i>
                                </button>
                            @endif
                            <button data-destroy="{{ route('admin.corrections.destroy', ['correction' => $correction->id]) }}" type="button" class="btn btn-danger btn-destroy">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        <td>{{ $correction->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $correction->updated_at->format('d.m.Y H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-5">Пока правок нет.</p>
        @endif
        {{ $corrections->links() }}
    </div>
    <div class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удалить правку</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
