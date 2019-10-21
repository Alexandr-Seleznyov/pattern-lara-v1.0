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


    <a href="http://pl1-client.loc/oauth2_client/auth_redirection.php" target="_blank">Demo - Авторизация и вывод инфо о пользователе со стороннего сайта (http://pl1-client.loc)</a>
    <br>


@endsection
