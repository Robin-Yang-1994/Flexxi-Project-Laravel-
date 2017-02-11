<?php


Route::get('/', function () {
  return view('auth.register');
}); // default webpage

Route::get('/help', 'HelpController@showHelp'); // website information

Auth::routes(); // middleware access for authentication

Route::get('/home', 'TimetableController@showTimetable'); // default home page (dashboard view after logging in)

Route::post('/profile', 'AccountController@showProfile'); // show profile information

Route::post('/profile/update/{user}', 'AccountController@updateProfile'); //update profile information

Route::post('/profile/upload/{user}', 'AccountController@uploadProfilePicture'); //update profile image

Route::get('/addTimetable', 'TimetableController@addForm'); // add new lesson (in timetable) form

Route::post('/newTimetable', 'TimetableController@addTimetable'); // add new lesson
