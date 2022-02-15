<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="yandex-verification" content="9974e0eee0f21447"/>
        <title>@lang('main.online_shop'): @yield('title') </title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/starter-template.css" rel="stylesheet">

    </head>
    <body @if(Route::currentRouteName() === 'questionnaire') onload="load();" @endif>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{route('questionnaires')}}">Все опросы</a>
            </div>
            <div class="navbar-header navbar-right">
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li><a href="{{route('login')}}">@lang('main.login')</a></li>
                    @endguest
                    @auth
                        <li class='nav-item'><a href="{{route('logout')}}">@lang('main.logout')</a></li>
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
    <footer>
        <div class="container"Ю
        </div>
    </footer>
    </body>
</html>
