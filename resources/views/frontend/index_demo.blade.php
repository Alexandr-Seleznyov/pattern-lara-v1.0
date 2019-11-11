@extends('frontend.layouts.app')
@section('content')

    <?php
//        use App\Models\Auth\User;
//        $paginator = User::paginate(3);
//
//
//        $paginator->getCollection()->transform(function ($value) {
//            $value['test'] = 123;
//            return $value;
//        });
//        dd($paginator->getCollection());
    ?>

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
    <br>
    <br>
    <br>

    <a href="http://pl1-client.loc/oauth2_client/auth_redirection.php" target="_blank">OAuth2 (Passport) Demo - Авторизация и вывод инфо о пользователе со стороннего сайта (http://pl1-client.loc)</a>
    <br>


@endsection
