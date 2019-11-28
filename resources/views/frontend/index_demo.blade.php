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

    {{--<img src="/photos/shares/demo_pic/task_1557420449_pwz9l4fm.png" alt="">--}}
    <?php

            use Intervention\Image\Facades\Image;

            function getLinkImage($link_image, $w = null, $h = null)
            {
                if (substr($link_image, 0,1) == '/') $link_image = substr($link_image, 1);
                $cache_link_image = 'cache_images/'.$w.'x'.$h.'/'.$link_image;

                if (\File::exists($cache_link_image)) return $cache_link_image;


//                // open and resize an image file
//                $img = Image::make($link_image)->resize($w, $h);

                // resize the image to a width of 300 and constrain aspect ratio (auto height)
                $img = Image::make($link_image)->resize($w, $h, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $dir ='';
                $arr = explode('/', $cache_link_image);
                for($i = 0; $i < count($arr) - 1; $i++){
                    $dir .= ($i==0 ? '' : '/') . $arr[$i];
                    if (!\File::exists($dir)) mkdir ( $dir );
                }

                // save file as jpg with medium quality
                $img->save($cache_link_image, 90);

                return $cache_link_image;
            };


        $link_image = '/photos/shares/demo_pic/task_1557420449_pwz9l4fm.png';
        $link_resize_image = getLinkImage($link_image, null, 100);
    ?>


    <img src="{{ $link_resize_image }}" alt="">


@endsection
