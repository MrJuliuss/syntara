<?php

Route::filter('basicAuth', function()
{
    if(!Sentry::check())
    {
        // save the attempted url
        Session::put('attemptedUrl', URL::current());

        return Redirect::route('getLogin');
    }

    View::share('currentUser', Sentry::getUser());
});

Route::filter('notAuth', function()
{
    if(Sentry::check())
    {
        $url = Session::get('attemptedUrl');
        Session::forget('attemptedUrl');

        return Redirect::to($url);
    }
});

Route::filter('hasPermissions', function()
{
    $permissions = Config::get('syntara::permissions');

    if (Route::currentRouteName() == "putUser" && Sentry::getUser()->id == Request::segment(3) ||
        Route::currentRouteName() == "showUser" && Sentry::getUser()->id == Request::segment(3))
    {
    }
    else
    {
        if(!Sentry::getUser()->hasAccess($permissions[Route::currentRouteName()]))
        {
            return Redirect::route('accessDenied');
        }
    }
});