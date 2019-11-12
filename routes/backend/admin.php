<?php

Route::get('/{any?}', function(){
    return view('backend.layouts.app');
})->where('path', '.*')
    ->where('any', '[\/\w\.-]*')
    ->name('home');