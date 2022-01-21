@extends('layouts.admin')


@section('content')

<div class="container">

    <h1>All Games</h1>
    <a class="btn btn-primary" href="{{route('admin.games.create')}}" role="button">Create</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cover Image</th>
                <th>Title</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach($games as $game)
            <tr>
                <td scope="row">{{$game->id}}</td>
                <td> <img width="50" src="{{$game->cover}}" alt=""></td>
                <td>{{$game->title}}</td>
                <td>
                    <a href="{{route('admin.games.show', $game->id)}}">View</a>
                    - Edit - Delete
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>


</div>

@endsection
