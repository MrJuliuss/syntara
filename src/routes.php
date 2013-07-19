<?php

Route::group(array('before' => 'auth', 'prefix' => 'dashboard'), function()
{
    Route::get('', array('as' => 'indexDashboard', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getIndex'));
    Route::get('logout', array('as' => 'logout', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getLogout'));
    Route::get('users', array('as' => 'listUsers', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@getIndex'));
    Route::post('user/delete', array('as' => 'deleteUsers', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@delete'));
	Route::post('user/new', array('as' => 'newUserPost', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@postCreate'));
    Route::get('user/new', array('as' => 'newUser', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@getCreate'));
	Route::get('user/{userId}', array('as' => 'showUser', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@getShow'));
	Route::put('user/{userId}', array('as' => 'putUser', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@putShow'));
});

Route::group(array('before' => 'notAuth', 'prefix' => 'dashboard'), function()
{
    Route::get('login', array('as' => 'getLogin', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getLogin'));
    Route::post('login', array('as' => 'postLogin', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@postLogin'));
});