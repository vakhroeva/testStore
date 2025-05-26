<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <main class="container">

        @php
            $isOrders = request()->routeIs('orders.*');
        @endphp

        <div class="d-flex justify-content-start gap-2 my-4">
            <a href="{{ route('products.index') }}" class="btn {{ $isOrders ? 'btn-outline-primary' : 'btn-primary' }}">Товары</a>
            <a href="{{ route('orders.index') }}" class="btn {{ $isOrders ? 'btn-primary' : 'btn-outline-primary' }}">Заказы</a>
        </div>

        @yield('content')
    </main>

</body>
</html>
