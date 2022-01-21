<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DC Admin- @yield('page-title', 'comics website')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

    <script src="{{asset('js/app.js')}}" defer></script>
</head>

<body>


    <div class="wrapper d-flex">
        <aside class="w-25">
            <div class="logo">
                <a href="{{route('home')}}">
                    <img src="{{asset('img/dc-logo.png')}}" alt="">
                </a>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link {{ Route::currentRouteName() === 'admin.posts.index' ? 'active' : '' }}" aria-current="page" href="{{route('admin.posts.index')}}">Posts</a>
                <a class="nav-link" href="#">Movies</a>
                <a class="nav-link {{ Route::currentRouteName() === 'admin.games.index' ? 'active' : '' }}" href="{{route('admin.games.index')}}">Games</a>
                <a class="nav-link" href="#">Comics</a>
                <a class="nav-link">Videos</a>
            </nav>

        </aside>
        <main class="container p-5">
            @yield('content')
        </main>
    </div>


</body>

</html>
