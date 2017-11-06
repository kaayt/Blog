<?php

Route::get('/', function() {
    return redirect()->route('posts.index');
});

Route::group([
    'as'     => 'posts',
    'prefix' => 'posts',
], function () {

    Route::get('/', [
        'as'   => '.index',
        'uses' => 'PostsController@index',
    ]);

    Route::get('/create', [
        'as'   => '.create',
        'uses' => 'PostsController@create',
    ]);

    Route::post('/', [
        'as'   => '.store',
        'uses' => 'PostsController@store',
    ]);

    Route::get('/{post}', [
        'as'   => '.show',
        'uses' => 'PostsController@show',
    ]);

    Route::post('/{post}/comments', [
        'as'   => '.commentStore',
        'uses' => 'CommentsController@store',
    ]);
});

Route::get('/register', 'RegistrationController@create');
//Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');




 


