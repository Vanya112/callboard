@extends('layouts.app')

@section('title', 'Callboard')

@section('content')

<div>
    <div class="card-body">
        <h4 class="card-title">{{$announcement->title}}</h4>
        <br>
        <article style="font-size: 20px;">
            Description: {!! $announcement->description !!}
        </article>
        <br>
        <p><img style="max-width: 1080px; max-height: 960px;" src="{{asset('storage'). "\\" . $announcement->user_name . "\\" . $announcement->id. "\\". $announcement->image_name}}"></p>
        <p class="card-text">Phone number: {{$announcement->phone_number}}</p>
        <p class="card-text">Created at: {{$announcement->created_at}}</p>
        <p class="card-text">Updated at: {{$announcement->updated_at}}</p>
        <a href="{{route('index')}}" class="btn btn-primary">Back</a>
        <br>
        @include('form.add-comment-form', [$announcement->id])
        <br>
        @include('includes.comment-search-strings', [$announcement->id])
        <br>
        @include('includes.comments', $comments)
    </div>
</div>

@endsection
