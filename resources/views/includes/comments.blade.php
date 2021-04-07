@foreach($comments as $comment)
    <div class="card mb-4">
        <div class="card-header">
            {{$comment->user_name}}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$comment->text}}</h5>
            <br>
            <p class="card-text">{{$comment->created_at}}</p>
        </div>
    </div>
@endforeach

{{$comments->links('vendor.pagination.bootstrap-4')}}
