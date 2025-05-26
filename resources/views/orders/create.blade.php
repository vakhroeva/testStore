@extends('layouts.layout')

@section('title', 'Страница создания заказа')

@section('content')

    <div class="container w-50">
        <h1 class="mb-4">Создание заказа</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="client_name" class="form-label">Имя клиента</label>
                <input type="text" name="client_name" id="client_name" class="form-control"
                       value="{{ old('client_name') }}" required>
            </div>

            <div class="mb-3">
                <label for="product_id" class="form-label">Товар</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">Выберите товар</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Количество</label>
                <input type="number" name="amount" id="amount" class="form-control"
                       value="{{ old('amount', 1) }}" min="1" required>
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">Комментарий</label>
                <textarea name="comment" id="comment" class="form-control" rows="4">{{ old('comment') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>

@endsection
