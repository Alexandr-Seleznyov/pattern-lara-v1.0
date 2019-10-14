@extends('frontend.layouts.app')
@section('content')

    <h1>index_demo</h1>
    <hr>

    <a href="{{ route('frontend.demo.locale') }}" target="_blank">Языки</a>
    <br>

    <a href="{{ route('frontend.demo.auth') }}" target="_blank">Авторизация/Регистрация</a>
    <br>

    <br>
    <br>

    <a href="{{ route('frontend.dashboard') }}" target="_blank">Страница только для верифицированных пользователей - dashboard</a>
    <br>
@endsection
