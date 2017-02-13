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

Route::post('/profile/delete/{user}', 'AccountController@deleteProfile'); // delete user profile

Route::get('/addTimetable', 'TimetableController@addForm'); // add new lesson (in timetable) form

Route::post('/newTimetable', 'TimetableController@addTimetable'); // add new lesson

Route::get('/events-tasks', 'TaskController@showTasks'); // show added tasks

Route::get('/addEvents-tasks', 'TaskController@addTasksForm'); // show added tasks form

Route::post('/addEvents-tasks/newEvents-tasks', 'TaskController@addTasks'); // add new task

Route::get('/events-tasks/{events}/edit', 'TaskController@editTasksForm'); // edit existing task

Route::post('/updateEvents-tasks/{events}', 'TaskController@updateTasks'); // update existing task

Route::post('/deleteEvents-tasks/{events}', 'TaskController@deleteTasks'); // delete existing task