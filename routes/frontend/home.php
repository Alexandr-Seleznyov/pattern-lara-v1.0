<?php

Route::get('/', function () {
//    return view('frontend.index');
    return view('frontend.index_demo');
})->name('home');


// Image resize from VUEJS
//Route::post('image-introduction', function(Request $request){
//    return $request;
//})->name('image_introduction');


Route::group(['middleware' => 'auth'], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard')
        ->middleware('verified');

});
