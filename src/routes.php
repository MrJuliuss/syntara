<?php

Route::group(array('before' => 'auth', 'prefix' => 'dashboard'), function()
{
    Route::get('', array('as' => 'indexDashboard', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getIndex'));
    Route::get('logout', array('as' => 'logout', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getLogout'));
    
    // Users
    Route::get('users', array('as' => 'listUsers', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@getIndex'));
    Route::delete('user/delete', array('as' => 'deleteUsers', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@delete'));
    Route::post('user/new', array('as' => 'newUserPost', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@postCreate'));
    Route::get('user/new', array('as' => 'newUser', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@getCreate'));
    Route::get('user/{userId}', array('as' => 'showUser', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@getShow'));
    Route::put('user/{userId}', array('as' => 'putUser', 'uses' => 'MrJuliuss\Syntara\Controllers\UserController@putShow'));
    
    // Groups
    Route::get('groups', array('as' => 'listGroups', 'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@getIndex'));
    Route::post('group/new', array('as' => 'newGroupPost', 'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@postCreate'));
    Route::get('group/new', array('as' => 'newGroup', 'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@getCreate'));
    Route::delete('group/delete', array('as' => 'deleteGroup', 'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@delete'));
    Route::get('group/{groupId}', array('as' => 'showGroup', 'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@getShow'));
    Route::put('group/{groupId}', array('as' => 'putGroup', 'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@putShow'));
});

Route::group(array('before' => 'notAuth', 'prefix' => 'dashboard'), function()
{
    Route::get('login', array('as' => 'getLogin', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getLogin'));
    Route::post('login', array('as' => 'postLogin', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@postLogin'));
});