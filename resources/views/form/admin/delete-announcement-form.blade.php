@extends('layouts.app')

@section('title', 'Callboard')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1>Delete Form</h1>
            <p class="lead text-muted">Do you really want delete this announcement?</p>
            {{ Form::open(array('route' => array('deleteAnnouncement', $announcement->id), 'method' => 'delete')) }}
            <p>
                <button type="submit" class="btn btn-primary my-2">
                    {{ __('Yes') }}
                </button>
                <a href="{{ route('index') }}" class="btn btn-primary my-2">No</a>
            </p>
            {{ Form::close() }}
        </div>
    </section>

@endsection
