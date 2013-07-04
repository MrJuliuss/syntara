<?php

/**
 * User required to be logged in
 */
Route::filter('auth', function()
{
	if(!Sentry::check()) 
    {
        return Redirect::route('getLogin');
    }
});

/**
 * User required to be disconnected
 */
Route::filter('notAuth', function()
{
    if(Sentry::check())
    {
        return Redirect::route('indexDashboard');
    }
});