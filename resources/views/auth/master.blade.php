<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Админка: @yield('title')</title>
        <script src="/js/app.js" defer></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/admin.css" rel="stylesheet">
        <link href="/css/starter-template.css" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('index') }}">Вернуться на сайт</a>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                                @admin
                                <li class="active"><a href="{{route('index')}}">Все товары</a></li>
                                <li ><a href="{{route('categories.index')}}">Категории</a></li>
                                <li ><a href="{{route('products.index')}}">Товары</a></li>
                                <li ><a href="{{route('properties.index')}}">Свойства</a></li>
                                <li ><a href="{{route('orders')}}">Заказы</a></li>
                                @else <li ><a href="{{ route('person.orders.index')}}">Мои Заказы</a></li>
                                @endadmin
                        </ul>
                        @guest
                            <ul class="nav navbar-nav navbar-right">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Войти</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
                                </li>
                            </ul>
                        @endguest
                        @auth
                            <ul class="nav navbar-nav navbar-right">
                                <li class="nav-item dropdown">
                                    @admin
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('orders')}}" role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" v-pre>
                                        Администратор
                                    </a>
                                    @else
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('person.orders.index')}}" role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" v-pre>
                                        Мои заказы
                                    </a>
                                    @endadmin
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle"  href="{{ route('logout')}}">
                                        Выйти
                                    </a>
                                    <form id="logout-form" action="{{ route('logout')}}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @endauth
                    </div>
                </div>
            </nav>
            <div class="py-4">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>
