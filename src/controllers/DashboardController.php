<?php namespace MrJuliuss\Syntara\Controllers;

use View;
use Input;
use Sentry;

class DashboardController extends BaseController 
{
    /**
     * 
     */
    public function index()
    {
        echo "index dashboard";
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
}