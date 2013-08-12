<?php

Route::filter('auth', function()
{
    if(!Sentry::check()) 
    {
        return Redirect::route('getLogin');
    }
});

Route::filter('notAuth', function()
{
    if(Sentry::check())
    {
        return Redirect::route('indexDashboard');
    }
});

Route::filter('hasPermissions', function()
{
    $permissions = Config::get('syntara::permissions');
    View::share('currentUser', Sentry::getUser());

    if(!Sentry::getUser()->hasAccess($permissions[Route::currentRouteName()]))
    {
        return Redirect::route('accessDenied');
    }
});