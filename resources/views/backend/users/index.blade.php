@extends('backend.layouts.app')
@section('content')

    <h1>Users</h1>
    <hr>

    <div class="panel-heading">Пользователи</div>

    <div class="panel-body table-responsive">
        <router-view name="UsersIndex"></router-view>
        <router-view></router-view>
    </div>

@endsection
