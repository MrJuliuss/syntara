<?php namespace MrJuliuss\Syntara\Controllers;

use View;
use Input;
use Sentry;
use Redirect;
use Validator;
use Config;
use Response;

class DashboardController extends BaseController 
{
    /**
    * Index loggued page
    */
    public function getIndex()
    {
        $this->layout = View::make('syntara::dashboard.index');
    }
    
    /**
    * Login page
    */
    public function getLogin()
    {
        $this->layout = View::make('syntara::dashboard.login');
    }

    /**
    * Login post authentication
    */
    public function postLogin()
    {
        try
        {
            $validator = Validator::make(
                Input::all(),
                Config::get('syntara::rules.users.login')
            );
            
            if($validator->fails())
            {
                return Response::json(array('logged' => false));
            }
            
            $credentials = array(
                'email'    => Input::get('email'),
                'password' => Input::get('pass'),
            );

            $user = Sentry::authenticate($credentials, false);
            
        }
        catch (\RuntimeException $e)
        {
            return Response::json(array('logged' => false));
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
}