@extends('frontend.layouts.app')
@section('content')
    <h1>Locale</h1>
    <hr>
    <h3>Текущий язык - <span class="badge badge-secondary">{{ app()->getLocale() }}</span></h3>

    <hr>
    <h4>Главный язык (в URI не отображается) - <span class="badge badge-secondary">{{ config('app.main_language', 'en') }}</span></h4>

    <h4>Все возможные языки:</h4>

    @foreach(config('app.languages', ['en']) as $value)
        <a href="{{ route('setlocale', ['lang' => $value]) }}">{{ trans('demo.go') }} - <span class="badge badge-secondary">{{ $value }}</span></a>
        <br>
    @endforeach

    <br>
    <hr>

    <h3>config/app.php</h3>

    <p>// Язык по умолчанию</p>
    <p>'main_language' => 'en',</p>
    <br>
    <p>// Все возможные языки</p>
    <p>'languages' => ['en', 'ru', 'uk'],</p>

    <br>
    <hr>

    <h3>App\Http\Kernel.php</h3>

    <p>protected $middleware = [</p>
    <p> ... </p>
    <p>\App\Http\Middleware\LocaleMiddleware::class,</p>
    <p>];</p>

@endsection
