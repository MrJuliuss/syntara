<?php namespace MrJuliuss\Syntara\Controllers;

use View;
use Input;
use Sentry;
use Redirect;

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
        $userLogin = Input::get('userLogin');
        $userPassword = Input::get('userPass');
        
        try
        {
            $credentials = array(
                'email'    => $userLogin,
                'password' => $userPassword,
            );

            $user = Sentry::authenticate($credentials, false);
            
        }
        catch (\RuntimeException $e)
        {
            return json_encode(array('logged' => false));
        }
        
        return json_encode(array('logged' => true));
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