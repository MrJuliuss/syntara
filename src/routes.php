<?php

Route::group(array('before' => 'auth'), function()
{
    Route::get('dashboard', array('as' => 'indexDashboard', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@index'));
    Route::get('dashboard/logout', array('as' => 'logout', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@logout'));
    Route::get('dashboard/users', array('as' => 'listUsers', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@index'));
    Route::post('dashboard/user/delete', array('as' => 'deleteUsers', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@delete'));
    Route::post('dashboard/user/new', array('as' => 'newUser', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@create'));
});

Route::group(array('before' => 'notAuth'), function()
{
    Route::get('dashboard/login', array('as' => 'getLogin', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getLogin'));
    Route::post('dashboard/login', array('as' => 'postLogin', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@postLogin'));
});