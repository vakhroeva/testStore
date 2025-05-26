@extends('layouts/layout')

@section('title', 'Страница редактирования товара')

@section('content')

    <div class="container w-50">
        <h1 class="mb-4">Редактирование товара</h1>

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

        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Категория</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">Выберите категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Цена (₽)</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" min="0"
                       value="{{ old('price', $product->price) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Обновить</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">Назад</a>
        </form>
    </div>

@endsection
