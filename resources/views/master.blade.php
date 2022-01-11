<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="yandex-verification" content="9974e0eee0f21447"/>
        <title>Интернет Магазин: @yield('title') </title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.js"></script>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/starter-template.css" rel="stylesheet">
    </head>
    <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{route('index')}}">Интернет Магазин</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li @routeactive('index')><a href="{{route('index')}}">Все товары</a></li>
                    <li @routeactive('categor*')><a href="{{route('categories')}}">Категории</a></li>
                    <li ><a href="{{route('basket')}}">В корзину</a></li>
                    <li><a href="{{ route('reset')}}">Сбросить проект в начальное состояние</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">₽<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="https://internet-shop.tmweb.ru/currency/RUB">₽</a></li>
                            <li><a href="https://internet-shop.tmweb.ru/currency/USD">$</a></li>
                            <li><a href="https://internet-shop.tmweb.ru/currency/EUR">€</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @guest
                    <li><a href="{{route('login')}}">Войти</a></li>                 
                    @endguest
                    @auth
                    @admin
                    <li class='nav-item'><a href="{{route('orders')}}">Панель администратора</a></li>
                    @else
                    <li class='nav-item'><a href="{{route('person.orders.index')}}">Мои заказы</a></li>
                    @endadmin
                    <li class='nav-item'><a href="{{route('logout')}}">Выйти</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class='container'>
        <div class="starter-template">
            @if (session()->has('success'))
                <p class="alert alert-success">{{session()->get('success')}}</p>
            @endif
            @if (session()->has('warning'))
                <p class="alert alert-warning">{{session()->get('warning')}}</p>
            @endif
            @yield('content')
        </div>
    </div>
    </body>
</html>
