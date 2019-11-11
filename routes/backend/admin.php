<?php

Route::get('/{any?}', function(){
    return view('backend.layouts.app');
})->where('path', '.*')->name('home')->where('any', '[\/\w\.-]*');
//})->where('any', '[\/\w\.-]*');