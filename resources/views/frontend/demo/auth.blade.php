@extends('frontend.layouts.app')
@section('content')

    <h1>auth</h1>
    <hr>

    <?php
        $user = Auth::user();
    ?>
    @if (isset($user))
        <h4>Авторизированный пользователь - <span class="badge badge-secondary">{{ $user->name }}</span></h4>
        <h5>Доступ к админке - <span class="badge {{ $user->isBack() ? 'badge-success' : 'badge-danger' }}">{{ $user->isBack() ? 'Да' : 'Нет' }}</span></h5>
        <h5>Доступ к фронту - <span class="badge {{ $user->isFront() ? 'badge-success' : 'badge-danger' }}">{{ $user->isFront() ? 'Да' : 'Нет' }}</span></h5>
    @else
        <h4>Пользователь не авторизирован</h4>
    @endif

    <hr>

    <h4>Роуты находятся в <span class="badge badge-secondary">vendor\laravel\framework\src\Illuminate\Routing\Router.php</span></h4>

    <a href="{{ route('login') }}" target="_blank">Login</a>
    <br>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>


    <a href="{{ route('register') }}" target="_blank">Register</a>
    <br>
    <br>

    <a href="{{ route('frontend.dashboard') }}" target="_blank">Страница только для верифицированных пользователей - dashboard</a>
    <br>
    <br>

@endsection
