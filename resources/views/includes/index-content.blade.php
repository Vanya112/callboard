<section class="jumbotron text-center">
    <div class="container">
        <h1>@yield('title')</h1>
        <p class="lead text-muted">All rights reserved.</p>
        @auth
            <p>
                <a href="{{route('getAddAnnouncementForm')}}" class="btn btn-primary my-2">Create announcement</a>
            </p>
        @endauth
    </div>
</section>
