<?php

Route::filter('basicAuth', function()
{
    if(!Sentry::check())
    {
        return Redirect::route('getLogin');
    }

    View::share('currentUser', Sentry::getUser());
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

    if (Route::currentRouteName() == "putUser" && Sentry::getUser()->id == Request::segment(3) ||
        Route::currentRouteName() == "showUser" && Sentry::getUser()->id == Request::segment(3)) {

    } else {
        if(!Sentry::getUser()->hasAccess($permissions[Route::currentRouteName()]))
        {
            return Redirect::route('accessDenied');
        }
    }
});