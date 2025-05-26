@extends('layouts.layout')

@section('title', 'Страница заказа')

@section('content')

    <h1 class="mb-4">Заказ #{{ $order->id }}</h1>

    <div class="mb-3">
        <strong>Клиент:</strong>
        {{ $order->client_name }}
    </div>

    <div class="mb-3">
        <strong>Товар:</strong>
        {{ $order->product->name ?? '—' }}
    </div>

    <div class="mb-3">
        <strong>Количество:</strong>
        {{ $order->amount }}
    </div>

    <div class="mb-3">
        <strong>Цена заказа:</strong>
        {{ number_format($order->price, 2) }} ₽
    </div>

    <div class="mb-3">
        <strong>Статус:</strong>
        {{ $order->status }}
    </div>

    @if($order->comment)
        <div class="mb-3">
            <strong>Комментарий:</strong>
            <p>{{ $order->comment }}</p>
        </div>
    @endif

    <div class="mb-3">
        <strong>Создан:</strong>
        {{ $order->created_at->format('d.m.Y') }}
    </div>

    @if( $order->status !== 'завершен')
        <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Редактировать</a>

        <form action="{{ route('orders.update', $order) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="завершен">
            <button type="submit" class="btn btn-success" onclick="return confirm('Завершить этот заказ?');">Завершить</button>
        </form>
    @endif

    <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить этот заказ?');">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Удалить</button>
    </form>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Назад к списку</a>

@endsection
