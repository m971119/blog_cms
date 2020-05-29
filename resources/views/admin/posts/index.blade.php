@extends('layouts.admin')


@section('content')
@if(session('deleted_post'))
    <p class="alert alert-danger">{{session('deleted_post')}}</p>
@endif
<h1>Posts</h1>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Title</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
    </thead>
    <tbody>
    @if($posts)
        @foreach ($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td><img height="50" src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder}}" alt=""></td>
            <td><a href="{{route('admin.posts.edit', $post->id) }}">{{$post->title}}</a></td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
            <td><a href="{{route('home.post', $post->id)}}">View Post</a></td>
            <td><a href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
            <td></td>

        </tr>
        @endforeach
    @endif

    </tbody>
</table>
<div class="row">
    <div class="col-sm-6 col-sm-offset-5">
        {{$posts->render()}}
    </div>

</div>

@stop
