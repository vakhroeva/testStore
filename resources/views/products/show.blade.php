@extends('layouts/layout')

@section('title', 'Страница товара')

@section('content')

    <h1 class="mb-4">{{ $product->name }}</h1>

    <div class="mb-3">
        <strong>Категория:</strong>
        {{ $product->category->name ?? '—' }}
    </div>

    <div class="mb-3">
        <strong>Цена:</strong>
        {{ number_format($product->price, 2) }} ₽
    </div>

    @if($product->description)
        <div class="mb-4">
            <strong>Описание:</strong>
            <p>{{ $product->description }}</p>
        </div>
    @endif

    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Редактировать</a>
    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить этот товар?');">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Удалить</button>
    </form>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">Назад к списку</a>

@endsection
