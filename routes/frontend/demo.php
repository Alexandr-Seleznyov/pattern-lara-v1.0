<?php

/*
|--------------------------------------------------------------------------
| Demo Routes
|--------------------------------------------------------------------------
*/

Route::prefix('demo')->group(function(){

    Route::get('locale', function () {
        return view('frontend.demo.locale');
    })->name('demo.locale');


    Route::get('auth', function () {
        return view('frontend.demo.auth');
    })->name('demo.auth');


});
