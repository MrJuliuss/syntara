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
        $this->layout = View::make('syntara::user.new-user');
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
                'last_name' => (string)Input::get('userLastName'),
                'first_name' => (string)Input::get('userFirstName')
            ));

            $activationCode = $user->getActivationCode();
            $user->attemptActivation($activationCode);
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            return json_encode(array('userCreated' => false, 'errorMessage' => 'Login is required...'));
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            return json_encode(array('userCreated' => false, 'errorMessage' => 'Passord is required...'));
        }
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            return json_encode(array('userCreated' => false, 'errorMessage' => 'User with this login already exists.'));
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
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Response::json(array('deletedUser' => false));
        }
        
        return Response::json(array('deletedUser' => true));
    }

    /**
    * View user account
    * @param int $userId
    */
    public function getShow($userId)
    {
        try
        {
            $user = Sentry::getUserProvider()->findById($userId);
            $throttle = Sentry::getThrottleProvider()->findByUserId($userId);
            $this->layout = View::make('syntara::user.show', array('user' => $user, 'throttle' => $throttle));
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->layout = View::make('syntara::dashboard.error', array('message' => 'Sorry, user not found ! '));
        }
    }

    /**
    * Update user account
    * @param int $userId
    * @return Response
    */
    public function putShow($userId)
    {
        try
        {
            // Find the user using the user id
            $user = Sentry::getUserProvider()->findById($userId);
            $user->username = Input::get('userName');
            $user->email = Input::get('userEmail');
            $user->last_name = Input::get('userLastName');
            $user->first_name = Input::get('userFirstName');
            
            $pass = Input::get('userPass');
            if(!empty($pass))
            {
                $user->password = $pass;
            }
            
            // Update the user
            if($user->save())
            {
                return Response::json(array('userUpdated' => true));
            }
            else 
            {
                return Response::json(array('userUpdated' => false, 'errorMessage' => 'Can not update this user, please try again.'));
            }
        }
        catch(\Cartalyst\Sentry\Users\UserExistsException $e)
        {   
            return Response::json(array('userUpdated' => false, 'errorMessage' => 'A user with this email already exists.'));
        }
        catch(\Exception $e)
        {
            return Response::json(array('userUpdated' => false, 'errorMessage' => 'A user with this username already exists.'));
        }
    }
}