<?php


Route::get('/', function () {
  return view('auth.register');
}); // default webpage

Route::get('/help', 'HelpController@showHelp'); // website information

Auth::routes(); // middleware access for authentication

Route::get('/home', 'HomeController@index'); // default home page (dashboard view after logging in)

Route::post('/profile', 'AccountController@showProfile'); // show profile information

Route::post('/profile/update/{user}', 'AccountController@updateProfile'); //update profile information

Route::post('/profile/upload/{user}', 'AccountController@uploadProfilePicture'); //update profile image
