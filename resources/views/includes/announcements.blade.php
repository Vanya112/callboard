@foreach($announcements as $announcement)
    <div class="card mb-4">
        <div class="card-header">
            {{$announcement->user_name}}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$announcement->title}}</h5>
            <br>
            <p class="card-text">Phone number: {{$announcement->phone_number}}</p>
            <p class="card-text">Created at: {{$announcement->created_at}}</p>
            <p class="card-text">Updated at: {{$announcement->updated_at}}</p>
            <p><img style="max-width: 360px; max-height: 360px" src="{{asset('storage'). "\\" . $announcement->user_name . "\\" . $announcement->id. "\\". $announcement->image_name}}"></p>
            <a href="{{route('getAnnouncement', [$announcement->id])}}" class="btn btn-primary">Read more</a>
            @auth
                @if ($announcement->user_name === Auth::user()['name'])
                    <a href="{{route('getEditAnnouncementForm', [$announcement->id])}}" class="btn btn-primary">Edit announcement</a>
                    <a href="{{route('getDeleteAnnouncementForm', [$announcement])}}" class="btn btn-primary">Delete announcement</a>
                @endif
            @endauth
        </div>
    </div>
@endforeach

{{$announcements->links('vendor.pagination.bootstrap-4')}}
