@if(session('comment_message'))
    <p class="alert alert-success">
        {{session('comment_message')}}
    </p>
@endif
