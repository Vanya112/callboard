@extends('layouts.app')

@section('title', 'Callboard')

@section('content')
    @include('includes.index-content')
    @include('includes.announcement-search-strings')
    @include('includes.announcements', [$announcements])
@endsection
