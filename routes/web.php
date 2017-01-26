<?php


Route::get('/', function () {
    return view('auth.register');
});


Route::get('/help', 'HelpController@showHelp');

Auth::routes();

//Route::get('/home', 'HomeController@index');
