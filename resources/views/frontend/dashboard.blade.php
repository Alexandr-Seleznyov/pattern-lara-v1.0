@extends('frontend.layouts.app')
@section('content')

    <h1>dashboard - front</h1>
    <hr>
    @if(session('message'))
        <h4>{{ session('message') }}</h4>
    @endif

@endsection
