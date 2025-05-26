@extends('layouts.layout')

@section('title', 'Страница редактирования заказа')

@section('content')

    <div class="container w-50">
        <h1 class="mb-4">Редактирование заказа</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ошибки при заполнении:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orders.update', $order) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="client_name" class="form-label">Имя клиента</label>
                <input type="text" name="client_name" id="client_name" class="form-control"
                       value="{{ old('client_name', $order->client_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="product_id" class="form-label">Товар</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">Выберите товар</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"
                            {{ old('product_id', $order->product_id) == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Количество</label>
                <input type="number" name="amount" id="amount" class="form-control" min="1"
                       value="{{ old('amount', $order->amount) }}" required>
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">Комментарий</label>
                <textarea name="comment" id="comment" class="form-control" rows="4">{{ old('comment', $order->comment) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Обновить</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary ms-2">Назад</a>
        </form>
    </div>

@endsection
