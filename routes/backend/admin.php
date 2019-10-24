<?php

Route::get('/', function(){
    return view('backend.dashboard');
})->where('path', '.*')->name('home');