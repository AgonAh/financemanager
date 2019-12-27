<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styling/style.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/e21d36c79c.js"></script>
</head>
@auth()
<body>
<div class="hero">
    <div class="header">
        <div class="container">
            <img src="/assets/Ubtlogo.png" class="ubtLogo">
            <div class="userInfo">
                <img src="/assets/male.png" class="userLogo">
                <h2 class="userName">{{Auth::user()->name}}</h2>
                <img src="/assets/down-arrow.png" class="menuButton">
            </div>
            <ul class="main-nav">
                <li id="invoiceLi"><a href="/">Fatura</a></li>
                <li id="historyLi"><a href="/history">Shiko historië</a></li>
                <li id="projectLi"><a href="/projects">Projektet</a></li>
            </ul>
        </div>
    </div>
@endauth
@yield('content')


</body>
</html>

<script>
    <?php if(isset($js))
        echo $js;
    ?>
</script>























<?php /*
    {{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <?php if(!isset($title)) $title = 'Financa';?>--}}
{{--    <title><?=$title?></title>--}}
{{--        <link rel="stylesheet" href="/resources/css/bootstrap.css">--}}
{{--</head>--}}
{{--<body>--}}

{{--<nav class="navbar navbar-expand-lg navbar-light bg-light">--}}
{{--    <a class="navbar-brand" href="/">Financa</a>--}}
{{--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--        <span class="navbar-toggler-icon"></span>--}}
{{--    </button>--}}

{{--@Auth--}}
{{--    <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--        <ul class="navbar-nav mr-auto">--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="/">Faktura</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="/projects">Projektet</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="/admin">Admin</a>--}}
{{--            </li>--}}

{{--        </ul>--}}
{{--        <ul class="navbar-nav navbar-right">--}}
{{--            @if(!isset(\Illuminate\Support\Facades\Auth::user()['id']))--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="/login">Login</a>--}}
{{--            </li>--}}
{{--            @else--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="/profile"><?=\Illuminate\Support\Facades\Auth::user()->name?></a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{ route('logout') }}"--}}
{{--                       onclick="event.preventDefault();--}}
{{--                        document.getElementById('logout-form').submit();">--}}
{{--                        {{ __('Logout') }}--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                        @csrf--}}
{{--                    </form>--}}

{{--            @endif--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--    @endauth--}}
{{--</nav>--}}


{{--@if(Session::has('success'))--}}
{{--    <div class="alert alert-success"><?=session('success')?></div>--}}
{{--@endif--}}

{{--@if(Session::has('failed'))--}}
{{--<div class="alert alert-danger"><?=session('failed')?></div>--}}
{{--@endif--}}
{{--@yield('content')--}}
{{--</body>--}}
{{--</html>--}}
