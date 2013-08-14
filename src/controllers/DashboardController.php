<?php 

namespace MrJuliuss\Syntara\Controllers;

use MrJuliuss\Syntara\Controllers\BaseController;
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
        $this->layout->content = View::make('syntara::dashboard.index');
    }
    
    /**
    * Login page
    */
    public function getLogin()
    {
        $this->layout->content = View::make('syntara::dashboard.login');
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
                 return Response::json(array('logged' => false, 'errorMessages' => $validator->messages()->getMessages()));
            }
            
            $credentials = array(
                'email'    => Input::get('email'),
                'password' => Input::get('pass'),
            );

            Sentry::authenticate($credentials, Input::get('remember'));
        }
        catch (\RuntimeException $e)
        {
            return Response::json(array('logged' => false, 'errorMessage' => 'Sorry, login failed... check your credentials.'));
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
        $this->layout->content = View::make('syntara::dashboard.error', array('message' => 'Sorry, access denied !'));
    }
}