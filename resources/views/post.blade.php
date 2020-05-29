@extends('layouts.blog-post')

@section('content')
    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by {{$post->user->name}}
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->file}}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">{{$post->body}}</p>
    <hr>

    <!-- Blog Comments -->
    @inject('auth', 'Illuminate\Support\Facades\Auth')

    @if(Auth::check())
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>

        {!! Form::open(['method'=>'POST', 'action'=>'PostsCommentsController@store']) !!}
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <div class="form-group">
                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}

    </div>
    @endif

    <hr>
    <!-- Posted Comments -->
    @if(count($comments) > 0)
    <!-- Comment -->
    @foreach ($comments as $comment)

    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" height="64" src="{{$comment->photo}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            <p>{{$comment->body}}</p>
            <div class="comment-reply-container">
                <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                <div class="comment-reply">
                    {!! Form::open(['method'=>'POST', 'action'=>'CommentsRepliesController@createReply']) !!}
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <div class="form-group">
                            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>2]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Submit Reply', ['class'=>'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>

            @if(count($comment->replies) > 0)
            @foreach($comment->replies as $reply)

                <!-- Nested Comment -->
                <div id="nested-comment" class="media">
                    <a class="pull-left" href="#">
                        <img height="64" class="media-object" src="{{$reply->photo}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$reply->author}}
                            <small>{{$reply->created_at->diffForHumans()}}</small>
                        </h4>
                        <p>{{$reply->body}}</p>
                    </div>

                </div>
                <!-- End Nested Comment -->
                @endforeach
                @endif
        </div>

    </div>
    @endforeach
    @endif

@endsection

@section('scripts')
<script>
    $(".comment-reply-container .toggle-reply").click(function(){
        $(this).next().toggle();

    });
</script>
@endsection
