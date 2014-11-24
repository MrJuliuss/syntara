<?php

namespace MrJuliuss\Syntara\Controllers;

use MrJuliuss\Syntara\Controllers\BaseController;
use MrJuliuss\Syntara\Services\Validators\User as UserValidator;
use View;
use Input;
use Response;
use Request;
use Sentry;
use Config;
use URL;
use PermissionProvider;
use DB;
use Mail;

class UserController extends BaseController
{

    /**
    * Display a list of all users
    *
    * @return Response
    */
    public function getIndex()
    {
        // get alls users
        $emptyUsers =  Sentry::getUserProvider()->getEmptyUser();

        // users search
        $userId = Input::get('userIdSearch');
        if(!empty($userId)) {
            $emptyUsers = $emptyUsers->where('users.id', $userId);
        }

        $username = Input::get('usernameSearch');
        if(!empty($username)) {
            $emptyUsers = $emptyUsers->where('username', 'LIKE', '%'.$username.'%');
        }

        $firstName = Input::get('firstNameSearch');
        if(!empty($firstName)) {
            $emptyUsers = $emptyUsers->where('first_name', 'LIKE', '%'.$firstName.'%');
        }

        $lastName = Input::get('lastNameSearch');
        if(!empty($lastName)) {
            $emptyUsers = $emptyUsers->where('last_name', 'LIKE', '%'.$lastName.'%');
        }

        $email = Input::get('emailSearch');
        if(!empty($email)) {
            $emptyUsers = $emptyUsers->where('email', 'LIKE', '%'.$email.'%');
        }

        $bannedUsers = Input::get('bannedSearch');
        if(isset($bannedUsers) && $bannedUsers !== "") {
            $emptyUsers = $emptyUsers->join('throttle', 'throttle.user_id', '=', 'users.id')
                ->where('throttle.banned', '=', $bannedUsers)
                ->select('users.id', 'users.username', 'users.last_name', 'users.first_name', 'users.email', 'users.permissions', 'users.activated');
        }

        $emptyUsers->distinct();

        $users = $emptyUsers->paginate(Config::get('syntara::config.item-perge-page'));
        $datas['links'] = $users->links();
        $datas['users'] = $users;

        // ajax request : reload only content container
        if(Request::ajax()) {
            $html = View::make(Config::get('syntara::views.users-list'), array('datas' => $datas))->render();

            return Response::json(array('html' => $html));
        }

        $this->layout = View::make(Config::get('syntara::views.users-index'), array('datas' => $datas));
        $this->layout->title = trans('syntara::users.titles.list');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.users');
    }

    /**
    * Show new user form view
    */
    public function getCreate()
    {
        $groups = Sentry::getGroupProvider()->findAll();
        $permissions = PermissionProvider::findAll();

        $this->layout = View::make(Config::get('syntara::views.user-create'), array('groups' => $groups, 'permissions' => $permissions));
        $this->layout->title = trans('syntara::users.titles.new');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_user');
    }

    /**
    * Create new user
    */
    public function postCreate()
    {
        try {
            $validator = new UserValidator(Input::all(), 'create');

            $permissionsValues = Input::get('permission');
            $permissions = $this->_formatPermissions($permissionsValues);

            if(!$validator->passes()) {
                return Response::json(array('userCreated' => false, 'errorMessages' => $validator->getErrors()));
            }

            // create user
            $user = Sentry::getUserProvider()->create(array(
                'email'    => Input::get('email'),
                'password' => Input::get('pass'),
                'username' => Input::get('username'),
                'last_name' => (string)Input::get('last_name'),
                'first_name' => (string)Input::get('first_name'),
                'permissions' => $permissions
            ));

            // activate user
            $activationCode = $user->getActivationCode();
            if(Config::get('syntara::config.user-activation') === 'auto') {
                $user->attemptActivation($activationCode);
            } elseif(Config::get('syntara::config.user-activation') === 'email') {
                $datas = array(
                    'code' => $activationCode,
                    'username' => $user->username
                );

                // send email
                Mail::queue(Config::get('syntara::mails.user-activation-view'), $datas, function ($message) use ($user) {
                    $message->from(Config::get('syntara::mails.email'), Config::get('syntara::mails.contact'))
                            ->subject(Config::get('syntara::mails.user-activation-object'));
                    $message->to($user->getLogin());
                });
            }

            $groups = Input::get('groups');
            if(isset($groups) && is_array($groups)) {
                foreach($groups as $groupId) {
                    $group = Sentry::getGroupProvider()->findById($groupId);
                    $user->addGroup($group);
                }
            }
        } catch (\Cartalyst\Sentry\Users\LoginRequiredException $e){} // already catch by validators
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e){} // already catch by validators
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e){} catch (\Cartalyst\Sentry\Users\UserExistsException $e) {
            return json_encode(array('userCreated' => false, 'message' => trans('syntara::users.messages.user-email-exists'), 'messageType' => 'danger'));
        } catch(\Exception $e) {
            return Response::json(array('userCreated' => false, 'message' => trans('syntara::users.messages.user-name-exists'), 'messageType' => 'danger'));
        }

        return json_encode(array('userCreated' => true, 'redirectUrl' => URL::route('listUsers')));
    }

    /**
     * Delete user
     * @param  int $userId
     * @return  Response
     */
    public function delete($userId)
    {
        try {
            if($userId !== Sentry::getUser()->getId()) {
                $user = Sentry::getUserProvider()->findById($userId);
                $user->delete();
            } else {
                return Response::json(array('deletedUser' => false, 'message' => trans('syntara::users.messages.remove-own-user'), 'messageType' => 'danger'));
            }
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Response::json(array('deletedUser' => false, 'message' => trans('syntara::users.messages.not-found'), 'messageType' => 'danger'));
        }

        return Response::json(array('deletedUser' => true, 'message' => trans('syntara::users.messages.remove-success'), 'messageType' => 'success'));
    }

    /**
     * Activate a user since the dashboard
     * @param  int $userId
     * @return Response
     */
    public function putActivate($userId)
    {
        try {
            $user = Sentry::getUserProvider()->findById($userId);
            $activationCode = $user->getActivationCode();
            $user->attemptActivation($activationCode);
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Response::json(array('deletedUser' => false, 'message' => trans('syntara::users.messages.not-found'), 'messageType' => 'danger'));
        } catch (\Cartalyst\Sentry\Users\UserAlreadyActivatedException $e) {
            return Response::json(array('deletedUser' => false, 'message' => trans('syntara::users.messages.activate-already'), 'messageType' => 'danger'));
        }

        return Response::json(array('deletedUser' => true, 'message' => trans('syntara::users.messages.activate-success'), 'messageType' => 'success'));
    }

    /**
     * Activate a user (from an email)
     * @param  string $activationCode
     */
    public function getActivate($activationCode)
    {
        $activated = false;
        try {
            // Find the user using the activation code
            $user = Sentry::getUserProvider()->findByActivationCode($activationCode);

            // Attempt to activate the user
            if($user->attemptActivation($activationCode)) {
                $message = trans("Your account is successfully activated.");
                $activated = true;
            } else {
                // User activation failed
                $message = trans("Your account could not be activated.");
            }
        } catch(\Exception $e) {
            // User not found, activation found or other errors
            $message = trans("Your account could not be activated.");
        }

        $this->layout = View::make(Config::get('syntara::views.user-activation'), array('activated' => $activated, 'message' => $message));
    }

    /**
    * View user account
    * @param int $userId
    */
    public function getShow($userId)
    {
        try {
            $user = Sentry::getUserProvider()->findById($userId);
            $throttle = Sentry::getThrottleProvider()->findByUserId($userId);
            $groups = Sentry::getGroupProvider()->findAll();

            // get user permissions
            $permissions = PermissionProvider::findAll();
            $userPermissions = array();
            foreach($user->getPermissions() as $permissionValue => $key) {
                try {
                    $p = PermissionProvider::findByValue($permissionValue);
                    foreach($permissions as $key => $permission) {
                        if($p->getId() === $permission->getId()) {
                            $userPermissions[] = $permission;
                            unset($permissions[$key]);
                        }
                    }
                } catch(\MrJuliuss\Syntara\Models\Permissions\PermissionNotFoundException $e){}
            }

            // ajax request : reload only content container
            if(Request::ajax()) {
                $html = View::make(Config::get('syntara::views.user-informations'), array('user' => $user, 'throttle' => $throttle))->render();

                return Response::json(array('html' => $html));
            }

            $this->layout = View::make(Config::get('syntara::views.user-profile'), array(
                'user' => $user,
                'throttle' => $throttle,
                'groups' => $groups,
                'ownPermissions' => $userPermissions,
                'permissions' => $permissions
            ));

            $this->layout->title = $user->username;
            $this->layout->breadcrumb = array(
                    array(
                        'title' => trans('syntara::breadcrumbs.users'),
                        'link' => URL::route('listUsers'),
                        'icon' => 'glyphicon-user'
                    ),
                    array(
                     'title' => $user->username,
                     'link' => URL::current(),
                     'icon' => ''
                    )
            );
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $this->layout = View::make(Config::get('syntara::views.error'), array('message' => trans('syntara::users.messages.not-found')));
        }
    }

    /**
    * Update user account
    * @param int $userId
    * @return Response
    */
    public function putShow($userId)
    {
        try {
            $validator = new UserValidator(Input::all(), 'update');

            if(!$validator->passes()) {
                return Response::json(array('userUpdated' => false, 'errorMessages' => $validator->getErrors()));
            }

            $permissionsValues = Input::get('permission');
            $permissions = $this->_formatPermissions($permissionsValues);

            // Find the user using the user id
            $user = Sentry::getUserProvider()->findById($userId);
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->last_name = Input::get('last_name');
            $user->first_name = Input::get('first_name');
            $user->permissions = $permissions;

            $currentUser = Sentry::getUser();
            $permissions = (empty($permissions)) ? '' : json_encode($permissions);
            $hasPermissionManagement = $currentUser->hasAccess(Config::get('syntara::permissions.addUserPermission')) || $currentUser->hasAccess('superuser');
            if($hasPermissionManagement === true) {
                DB::table('users')
                    ->where('id', $userId)
                    ->update(array('permissions' => $permissions));
            }

            $pass = Input::get('pass');
            if(!empty($pass)) {
                $user->password = $pass;
            }

            // Update the user
            if($user->save()) {
                // if the user has permission to update
                $banned = Input::get('banned');
                if(isset($banned) && Sentry::getUser()->getId() !== $user->getId()) {
                    $this->_banUser($userId, $banned);
                }

                if($currentUser->hasAccess(Config::get('syntara::permissions.addUserGroup'))) {
                    $groups = (Input::get('groups') === null) ? array() : Input::get('groups');
                    $userGroups = $user->getGroups()->toArray();

                    foreach($userGroups as $group) {
                        if(!in_array($group['id'], $groups)) {
                            $group = Sentry::getGroupProvider()->findById($group['id']);
                            $user->removeGroup($group);
                        }
                    }
                    if(isset($groups) && is_array($groups)) {
                        foreach($groups as $groupId) {
                            $group = Sentry::getGroupProvider()->findById($groupId);
                            $user->addGroup($group);
                        }
                    }
                }

                return Response::json(array('userUpdated' => true, 'message' => trans('syntara::users.messages.update-success'), 'messageType' => 'success'));
            } else {
                return Response::json(array('userUpdated' => false, 'message' => trans('syntara::users.messages.update-fail'), 'messageType' => 'danger'));
            }
        } catch(\Cartalyst\Sentry\Users\UserExistsException $e) {
            return Response::json(array('userUpdated' => false, 'message' => trans('syntara::users.messages.user-email-exists'), 'messageType' => 'danger'));
        } catch(\Exception $e) {
            return Response::json(array('userUpdated' => false, 'message' => trans('syntara::users.messages.user-name-exists'), 'messageType' => 'danger'));
        }
    }

    protected function _formatPermissions($permissionsValues)
    {
        $permissions = array();
        if(!empty($permissionsValues)) {
            foreach($permissionsValues as $key => $permission) {
               $permissions[$key] = 1;
            }
        }

        return $permissions;
    }

    protected function _banUser($userId, $value)
    {
        $throttle = Sentry::findThrottlerByUserId($userId);
        if($value === 'no' && $throttle->isBanned() === true) {
            $throttle->unBan();
        } elseif($value === 'yes' && $throttle->isBanned() === false) {
            $throttle->ban();
        }
    }
}
