<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Переключение языков
Route::get('setlocale/{lang}', function ($lang) {

    $referer = Redirect::back()->getTargetUrl(); //URL предыдущей страницы
    $parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы

    //разбиваем на массив по разделителю
    $segments = explode('/', $parse_url);

    //Если URL (где нажали на переключение языка) содержал корректную метку языка
    if (in_array($segments[1], config('app.languages', ['en']))) {
        unset($segments[1]); //удаляем метку
    }

    //Добавляем метку языка в URL (если выбран не язык по-умолчанию)
    if ($lang != config('app.main_language', 'en')){
        array_splice($segments, 1, 0, $lang);
    }

    //формируем полный URL
    $url = Request::root().implode("/", $segments);

    //если были еще GET-параметры - добавляем их
    if(parse_url($referer, PHP_URL_QUERY)){
        $url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
    }
    return redirect($url); //Перенаправляем назад на ту же страницу

})->name('setlocale');






/*
 * Frontend Routes
 */
Route::group(['prefix' => App\Http\Middleware\LocaleMiddleware::getLocale()], function() {


    Auth::routes(['verify' => true]);

    Route::get('logout', function(){
        auth()->logout();
        return redirect(route('frontend.home'));
    })->name('logout');



    Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
        include_route_files(__DIR__ . '/frontend/');
    });

});





/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth','admin']], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     * These routes can not be hit if the password is expired
     */
        include_route_files(__DIR__.'/backend/');

});

//Route::group(['namespace' => 'Backend', 'as' => 'admin.', 'prefix' => 'demo-coreui', 'middleware' => ['auth','admin']], function () {
//    Route::get('/{any?}', function(){
//        return view('backend.layouts.app_demo_coreui');
//    })->where('path', '.*');
//});
