@extends('layouts.admin')


@section('content')

<h1>Welcome to the dashboard</h1>
<aside class="w-25">
    <nav class="nav flex-column">
        <a class="nav-link active" aria-current="page" href="{{route('admin.posts.index')}}">Posts</a>
        <a class="nav-link" href="#">Movies</a>
        <a class="nav-link" href="#">Comics</a>
        <a class="nav-link disabled">Videos</a>
    </nav>

</aside>

@endsection
