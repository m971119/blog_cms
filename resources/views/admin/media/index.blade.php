@extends('layouts.admin')

@section('content')
    <h1>Media</h1>
    @if(session('deleted_photo'))
        <p class="alert alert-danger">{{session('deleted_photo')}}</p>
    @endif
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>
        @if($photos)
            @foreach ($photos as $photo)
            <tr>
                <td>{{$photo->id}}</td>
                <td><img height="50" src="{{$photo->file}}" alt=""></td>
                <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'no date'}}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id]]) !!}
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
@stop
