@extends('layouts.layout')

@section('title', 'Список заказов')

@section('content')

    <h1 class="mb-4">Список заказов</h1>

    @if(session('success'))
        <div class="alert alert-info">
            {{ session('success') }}
        </div>
    @endif

    @if(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif

    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Создать заказ</a>

    @if($orders->count())
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Дата создания</th>
                <th>Клиент</th>
                <th>Статус</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">
                            # {{ $order->id }}
                        </a>
                    </td>
                    <td> {{ $order->created_at->format('d.m.Y') }} </td>
                    <td>{{ $order->client_name }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->price }}</td>
                    <td>
                        @if( $order->status === 'новый')
                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-warning">Редактировать</a>

                            <form action="{{ route('orders.update', $order) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="завершен">
                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Завершить этот заказ?');">Завершить</button>
                            </form>
                        @endif

                        <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить этот заказ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $orders->links() }} {{-- Пагинация --}}
    @else
        <p>Заказы отсутствуют.</p>
    @endif

@endsection
