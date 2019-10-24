@extends('backend.layouts.app')
@section('content')

    <h1>dashboard - back</h1>
    <hr>
    <router-view name="UsersIndex"></router-view>
    <router-view></router-view>
@endsection
