@extends('layouts.admin')

@section('title')
    <title>Заказы</title>
@endsection

@section('content')
    <div class="text-center">
        <h2 class="h2 mb-5 display-4">Заказы</h2>
        <div class="container pb-3 mb-3 border-bottom">
            <div class="row justify-content-around">
                <div class="text-center" style="width: 200px">
                    <a href="{{ route('admin.manage.orders.index') }}" class="btn btn-dark">Все заказы</a>
                </div>
                <div class="text-center" style="width: 200px">
                    <a href="{{ route('admin.manage.orders.index', ['active' => 1]) }}" class="btn btn-success">Только новые</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-around">
                <div class="text-center" style="width: 200px">
                    <div class="card border-dark">
                        <div class="card-header display-5" style="color:#fff; background-color: #343a40; padding: 0">Всего заказов</div>
                        <div class="card-body text-dark" style="font-size: 25px; padding: 0">{{ $ordersCount }}</div>
                    </div>
                </div>
                <div class="text-center" style="width: 200px">
                    <div class="card border-dark">
                        <div class="card-header display-5" style="color:#fff; background-color:#009d00; padding: 0">Новых заказов</div>
                        <div class="card-body text-dark" style="font-size: 25px; padding: 0">{{ $activeOrdersCount }}</div>
                    </div>
                </div>
            </div>
        </div>
        @if(! empty($orders) && $orders->count() > 0)
            <table class="table table-bordered table-hover mt-5">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Компания</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Просмотрено</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="align-middle" data-id="{{ $order->id }}">{{ $order->id }}</td>
                        <td class="align-middle">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td class="align-middle">{{ $order->customer_name }}</td>
                        <td class="align-middle">{{ $order->customer_company }}</td>
                        <td class="align-middle">{{ $order->customer_email }}</td>
                        <td class="align-middle">{{ $order->customer_phone }}</td>
                        <td class="align-middle">
                            <a href="{{ route('user.catalog.show', ['machine' => $order->machine->slug]) }}" class="btn btn-info" target="_blank">{{ $order->machine->short_name }}</a>
                        </td>
                        <td class="align-middle">
                            @if($order->viewed)
                                    <i class="fas fa-check"></i>
                            @else
                                <button type="button" data-manage="{{ $order->id }}" class="btn btn-success js-viewed" data-viewed="{{ route('admin.manage.orders.viewed', ['order' => $order->id]) }}">Просмотреть</button>
                            @endif
                        </td>
                        <td>
                            <button data-destroy="{{ route('admin.manage.orders.destroy', ['order' => $order->id]) }}" type="button" class="btn btn-danger btn-destroy">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-5">Пока заказов нет.</p>
        @endif
        {{ $orders->links() }}
    </div>
    <div class="js-delete modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удалить заказ</h4>
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
    <div class="new-modal modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ошибка</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Заказ уже обработан</p>
                    <button type="button" class="btn btn-danger js-order-error" data-dismiss="modal" aria-label="Close">Ok</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('.js-viewed').on('click', function () {
            var $this = $(this);
            $.ajax({
                url: $this.data('viewed'),
                type: 'PUT',
                processData: false,
                cache: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function (response) {
                    $this.parent().html('<i class="fas fa-check"></i>');
                },
                error: function (response) {
                    if (response.status === 422) {
                        $('.new-modal').modal();
                        $this.parent().html('<i class="fas fa-check"></i>')
                    } else {
                        console.error(response);
                    }
                }
            });
        });

        $('.btn-destroy').on('click', function () {
            $('.js-delete ').find('form').attr('action', $(this).data('destroy'));
            $('.js-delete ').modal();
        });
    </script>
@endpush
