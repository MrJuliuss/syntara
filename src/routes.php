<?php

Route::group(array('before' => 'auth'), function()
{
    Route::get('dashboard', array('as' => 'indexDashboard', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@index'));
    Route::get('dashboard/logout', array('as' => 'logout', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@logout'));
});

Route::group(array('before' => 'notAuth'), function()
{
    Route::get('dashboard/login', array('as' => 'getLogin', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getLogin'));
    Route::post('dashboard/login', array('as' => 'postLogin', 'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@postLogin'));
});