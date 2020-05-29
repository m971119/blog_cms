@extends('layouts.admin')

@section('content')
    @if(count($replies) > 0)
    <h1>Replies</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
            </tr>
        </thead>
        <tbody>
        @if($replies)
            @foreach ($replies as $reply)
            <tr>
                <td>{{$reply->id}}</td>
                <td>{{$reply->author}}</td>
                <td>{{$reply->email}}</td>
                <td>{{str_limit($reply->body, 20)}}</td>
                <td><a href="{{route('home.post', $reply->comment->post->id)}}">View Post</a></td>
                <td>
                    @if($reply->is_active == 1)
                        {!! Form::open(['method'=>'PATCH', 'action'=>['CommentsRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {!! Form::submit('Unapprove', ['class'=>'btn btn-success']) !!}
                            </div>
                        {!! Form::close() !!}
                        @else
                        {!! Form::open(['method'=>'PATCH', 'action'=>['CommentsRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                            </div>
                        {!! Form::close() !!}

                    @endif
                </td>
                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['CommentsRepliesController@destroy', $reply->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        @endif

        </tbody>
    </table>
    @else
        <h1 class="text-center">No Replies</h1>
    @endif
@stop
