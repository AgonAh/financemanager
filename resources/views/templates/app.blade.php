<!DOCTYPE html>
<html>
<head>
    <?php if(!isset($title)) $title = 'Financa';?>
    <title><?=$title?></title>
        <link rel="stylesheet" href="/resources/css/bootstrap.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Financa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

@Auth
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Faktura</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/projects">Projektet</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin">Admin</a>
            </li>

        </ul>
        <ul class="navbar-nav navbar-right">
            @if(!isset(\Illuminate\Support\Facades\Auth::user()['id']))
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
                @endif

                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
        </ul>
    </div>
    @endauth
</nav>


@if(Session::has('success'))
    <div class="alert alert-success"><?=session('success')?></div>
@endif

@if(Session::has('failed'))
<div class="alert alert-danger"><?=session('failed')?></div>
@endif
@yield('content')
</body>
</html>
