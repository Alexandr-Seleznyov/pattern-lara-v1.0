<?php

Route::get('/', function () {
//    return view('frontend.index');
    return view('frontend.index_demo');
})->name('home');



Route::group(['middleware' => 'auth'], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard')
        ->middleware('verified');

});
