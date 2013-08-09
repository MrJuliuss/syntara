<?php namespace MrJuliuss\Syntara\Controllers;

use View;
use Input;
use Response;
use Request;
use Sentry;
use Validator;
use Config;

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
        
        $this->layout = View::make('syntara::user.index-user', array('datas' => $datas));
    }
    
    /**
    * Show new user form view
    */
    public function getCreate()
    {
        $groups = Sentry::getGroupProvider()->findAll();
        
        $this->layout = View::make('syntara::user.new-user', array('groups' => $groups));
    }

    /**
    * Create new user
    */
    public function postCreate()
    {
        try
        {
            $validator = Validator::make(
                Input::all(),
                Config::get('syntara::rules.users.create')
            );
            
            if($validator->fails())
            {
                return Response::json(array('userCreated' => false, 'errorMessages' => $validator->messages()->getMessages()));
            }
            
            $user = Sentry::getUserProvider()->create(array(
                'email'    => Input::get('email'),
                'password' => Input::get('pass'),
                'username' => Input::get('username'),
                'last_name' => (string)Input::get('last_name'),
                'first_name' => (string)Input::get('first_name')
            ));
            
            $activationCode = $user->getActivationCode();
            $user->attemptActivation($activationCode);
            $groups = Input::get('groups');
            if(isset($groups) && is_array($groups))
            {
                foreach($groups as $groupId)
                {
                    $group = Sentry::getGroupProvider()->findById($groupId);
                    $user->addGroup($group);
                }
            }
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e){} // already catch by validators
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e){} // already catch by validators
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e){}
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            return json_encode(array('userCreated' => false, 'message' => 'User with this login already exists.', 'messageType' => 'error'));
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
            return Response::json(array('deletedUser' => false, 'message' => 'User does not exists.', 'messageType' => 'error'));
        }
        
        return Response::json(array('deletedUser' => true, 'message' => 'User removed with success.', 'messageType' => 'success'));
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
            $groups = Sentry::getGroupProvider()->findAll();
            
            $this->layout = View::make('syntara::user.show-user', array(
                'user' => $user,
                'throttle' => $throttle,
                'groups' => $groups,
            ));
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
            $validator = Validator::make(
                Input::all(),
                Config::get('syntara::rules.users.show')
            );
            if($validator->fails())
            {
                return Response::json(array('userUpdated' => false, 'errorMessages' => $validator->messages()->getMessages()));
            }
            
            // Find the user using the user id
            $user = Sentry::getUserProvider()->findById($userId);
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->last_name = Input::get('last_name');
            $user->first_name = Input::get('first_name');
            
            $pass = Input::get('pass');
            if(!empty($pass))
            {
                $user->password = $pass;
            }
            
            // Update the user
            if($user->save())
            {
                $groups = (Input::get('groups') === null) ? array() : Input::get('groups');
                $userGroups = $user->getGroups()->toArray();
                
                foreach($userGroups as $group)
                {
                    if(!in_array($group['id'], $groups))
                    {
                        $group = Sentry::getGroupProvider()->findById($group['id']);
                        $user->removeGroup($group);
                    }
                }
                if(isset($groups) && is_array($groups))
                {
                    foreach($groups as $groupId)
                    {
                        $group = Sentry::getGroupProvider()->findById($groupId);
                        $user->addGroup($group);
                    }
                }
                
                return Response::json(array('userUpdated' => true, 'message' => 'User has been updated with success.', 'messageType' => 'success'));
            }
            else 
            {
                return Response::json(array('userUpdated' => false, 'message' => 'Can not update this user, please try again.', 'messageType' => 'error'));
            }
        }
        catch(\Cartalyst\Sentry\Users\UserExistsException $e)
        {   
            return Response::json(array('userUpdated' => false, 'message' => 'A user with this email already exists.', 'messageType' => 'error'));
        }
        catch(\Exception $e)
        {
            return Response::json(array('userUpdated' => false, 'message' => 'A user with this username already exists.', 'messageType' => 'error'));
        }
    }
}