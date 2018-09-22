<?php

Route::get('/', 'GuestController@welcome');

// Route::get('/mail', function(){
//     $user = \App\User::find(1);

//     return new \App\Mail\ActivateUserAccount($user);
// });

Route::get('/activate-account/{token}', 'GuestController@verify')->name('activate-account');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/user/playlists', 'PlaylistController@index');
// Route::post('/playlist', 'PlaylistController@store');
