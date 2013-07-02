<?php

/**
 * User required to be logged in
 */
Route::filter('auth', function()
{
	if(Sentry::check()) 
    {
        
    }
});

/**
 * User required to be disconnected
 */
Route::filter('notAuth', function()
{
    if(Sentry::check())
    {
        
    }
});