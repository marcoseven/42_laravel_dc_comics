@extends('layouts.app')


@section('content')

<div class="heading d-flex justify-content-between">
    <h1>All Posts in a table</h1>
    <a class="btn btn-primary" href="{{route('admin.posts.create')}}" role="button">Create</a>
</div>

<div class="container">

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Create At</th>
                <th>Updated At</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td scope="row">{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->updated_at}}</td>
                <td>View - edit - delete</td>
            </tr>
            @endforeach

        </tbody>
    </table>

    {{$posts->links()}}
</div>

@endsection
