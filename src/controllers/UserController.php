<?php namespace MrJuliuss\Syntara\Controllers;

use View;
use Input;
use Response;
use Request;
use Sentry;

class UserController extends BaseController {

	/**
	 * Display a list of all users
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$users =  Sentry::getUserProvider()->getEmptyUser()->paginate(20);
		
        $datas['links'] = $users->links();
        $datas['users'] = $users;
        if(Request::ajax())
        {
			$html = View::make('syntara::user.list-users', array('datas' => $datas))->render();
            
			return Response::json(array('html' => $html));
        }
        
		$this->layout = View::make('syntara::user.index', array('datas' => $datas));
	}
    
    /**
     * Show new user form view
     */
    public function getCreate()
    {
		$this->layout = View::make('syntara::user.new');
    }

    /**
	 * Create new user
	 */
	public function postCreate()
	{
        try
        {
            $user = Sentry::getUserProvider()->create(array(
                'email'    => Input::get('userEmail'),
                'password' => Input::get('userPass'),
                'username' => Input::get('userName'),
                'last_name' => Input::get('userLastName'),
                'first_name' => Input::get('userFirstName')
            ));
        }
        catch (\RuntimeException $e)
        {
            return json_encode(array('userCreated' => false));
        }
        
        return json_encode(array('userCreated' => true));
	}
    
    /**
     * Delete a user
     */
    public function delete()
    {
        try
        {
            $user = Sentry::getUserProvider()->findById(Input::get('userId'));
            $user->delete();
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Response::json(array('deletedUser' => false));
        }
        return Response::json(array('deletedUser' => true));
    }
}