<?php

namespace MrJuliuss\Syntara\Controllers;

use MrJuliuss\Syntara\Controllers\BaseController;
use MrJuliuss\Syntara\Services\Validators\User as UserValidator;
use View;
use Input;
use Sentry;
use Redirect;
use Config;
use Response;

class DashboardController extends BaseController
{
    /**
    * Index loggued page
    */
    public function getIndex()
    {
        $this->layout = View::make(Config::get('syntara::views.dashboard-index'));
        $this->layout->title = trans('syntara::all.titles.index');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.dashboard');
    }

    /**
    * Login page
    */
    public function getLogin()
    {
        $loginAttribute = Config::get('cartalyst/sentry::users.login_attribute');
        $this->layout = View::make(Config::get('syntara::views.login'), array('loginAttribute' => $loginAttribute));
        $this->layout->title = trans('syntara::all.titles.login');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.login');
    }

    /**
    * Login post authentication
    */
    public function postLogin()
    {
        try {
            $validator = new UserValidator(Input::all(), 'login');
            $loginAttribute = Config::get('cartalyst/sentry::users.login_attribute');

            if(!$validator->passes()) {
                 return Response::json(array('logged' => false, 'errorMessages' => $validator->getErrors()));
            }


            $credentials = array(
                $loginAttribute => Input::get($loginAttribute),
                'password' => Input::get('pass'),
            );

            // authenticate user
            Sentry::authenticate($credentials, (bool)Input::get('remember'));
        } catch(\Cartalyst\Sentry\Throttling\UserBannedException $e) {
            return Response::json(array('logged' => false, 'errorMessage' => trans('syntara::all.messages.banned'), 'errorType' => 'danger'));
        } catch (\RuntimeException $e) {
            return Response::json(array('logged' => false, 'errorMessage' => trans('syntara::all.messages.login-failed'), 'errorType' => 'danger'));
        }

        return Response::json(array('logged' => true));
    }

    /**
    * Logout user
    */
    public function getLogout()
    {
        Sentry::logout();

        return Redirect::route('indexDashboard');
    }

    /**
    * Access denied page
    */
    public function getAccessDenied()
    {
        $this->layout = View::make(Config::get('syntara::views.error'), array('message' => trans('syntara::all.messages.denied')));
        $this->layout->title = trans('syntara::all.titles.error');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.dashboard');
    }
}
