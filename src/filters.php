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
        if(!isset($url))
        {
            $url = URL::route('indexDashboard');
        }
        Session::forget('attemptedUrl');

        return Redirect::to($url);
    }
});

Route::filter('hasPermissions', function($route, $request, $userPermission = null)
{
    if (Route::currentRouteNamed('putUser') && Sentry::getUser()->id == Request::segment(3) ||
        Route::currentRouteNamed('showUser') && Sentry::getUser()->id == Request::segment(3))
    {
    }
    else
    {
        if($userPermission === null)
        {
            $permissions = Config::get('syntara::permissions');
            $permission = $permissions[Route::current()->getName()];
        }
        else
        {
            $permission = $userPermission;
        }

        if(!Sentry::getUser()->hasAccess($permission))
        {
            return Redirect::route('accessDenied');
        }
    }
});