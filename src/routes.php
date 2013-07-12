<?php

Route::group(array('before' => 'auth'), function()
{
    Route::get('dashboard', array('as' => 'indexDashboard', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getIndex'));
    Route::get('dashboard/logout', array('as' => 'logout', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getLogout'));
    Route::get('dashboard/users', array('as' => 'listUsers', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@getIndex'));
    Route::post('dashboard/user/delete', array('as' => 'deleteUsers', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@delete'));
	Route::post('dashboard/user/new', array('as' => 'newUserPost', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@postCreate'));
    Route::get('dashboard/user/new', array('as' => 'newUser', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@getCreate'));
});

Route::group(array('before' => 'notAuth'), function()
{
    Route::get('dashboard/login', array('as' => 'getLogin', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getLogin'));
    Route::post('dashboard/login', array('as' => 'postLogin', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@postLogin'));
});