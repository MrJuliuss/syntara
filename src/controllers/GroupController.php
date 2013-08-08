<?php namespace MrJuliuss\Syntara\Controllers;

use View;
use Validator;
use Input;
use Config;
use Response;
use Sentry;
use Request;
use DB;

class GroupController extends BaseController {

    /**
    * List of groups
    */
    public function getIndex()
    {
        $groups = Sentry::getGroupProvider()->createModel()->paginate(20);
        $datas['groups'] = $groups;
        if(Request::ajax())
        {
            $html = View::make('syntara::group.list-groups', array('datas' => $datas))->render();
            
            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make('syntara::group.index-group', array('datas' => $datas));
    }
    
    /**
    * Show create group view
    */
    public function getCreate()
    {
        $this->layout = View::make('syntara::group.new-group');
    }

    /**
    * Create group
    */
    public function postCreate()
    {
        $permissionsValues = Input::get('permission');
        $groupname = Input::get('groupname');
        $permissions = array();
        
        $errors = $this->_validateGroup($permissionsValues, $groupname, $permissions);
        if(!empty($errors))
        {
            return Response::json(array('groupCreated' => false, 'errorMessages' => $errors));
        }
        else 
        {
            try
            {
                Sentry::getGroupProvider()->create(array(
                    'name' => $groupname,
                    'permissions' => $permissions,
                ));
            }
            catch (\Cartalyst\Sentry\Groups\NameRequiredException $e) {}
            catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
            {
                return Response::json(array('groupCreated' => false, 'errorMessage' => 'Group with this name already exists.'));
            }
        }

        return Response::json(array('groupCreated' => true));
    }
    
    /**
     * Show group
     * @param type $groupId
     */
    public function getShow($groupId)
    {
        try
        {
            $group = Sentry::getGroupProvider()->findById($groupId);
            $userids = array();
            foreach(Sentry::getUserProvider()->findAllInGroup($group) as $user) 
            {
                $userids[] = $user->id;
            }
            
            
            $users = Sentry::getUserProvider()->createModel()->join('users_groups', 'users.id', '=', 'users_groups.user_id')->where('users_groups.group_id', '=', $group->getId())
                    ->paginate(20);
            
            if(Request::ajax())
            {
                $html = View::make('syntara::group.list-users-group', array('users' => $users))->render();
                
                return Response::json(array('html' => $html));
            }
            
            $this->layout = View::make('syntara::group.show-group', array('group' => $group, 'users' => $users));
        }
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            $this->layout = View::make('syntara::dashboard.error', array('message' => 'Sorry, group not found !'));
        }
    }

    /**
     * Edit group action
     * @param int $groupId
     */
    public function putShow($groupId)
    {
        $permissionsValues = Input::get('permission');
        $groupname = Input::get('groupname');
        $permissions = array();
        
        $errors = $this->_validateGroup($permissionsValues, $groupname, $permissions);
        if(!empty($errors))
        {
            return Response::json(array('groupUpdated' => false, 'errorMessages' => $errors));
        }
        else 
        {
            try
            {
                $group = Sentry::getGroupProvider()->findById($groupId);
                $group->name = $groupname;

                // delete permissions in db
                DB::table('groups')
                    ->where('id', $groupId)
                    ->update(array('permissions' => json_encode($permissions)));
                
                if($group->save())
                {
                    return Response::json(array('groupUpdated' => true));
                }
                else 
                {
                    return Response::json(array('groupUpdated' => false, 'errorMessage' => 'Can not update this group, please try again.'));
                }
            }
            catch (\Cartalyst\Sentry\Groups\NameRequiredException $e) {}
            catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
            {
                return Response::json(array('groupUpdated' => false, 'errorMessage' => 'Group with this name already exists.'));
            }
        }

        return Response::json(array('groupUpdated' => true));
    }
       
    /**
    * Delete groupe
    * @return Response
    */
    public function delete()
    {
        try
        {
            $group = Sentry::getGroupProvider()->findById(Input::get('groupId'));
            $group->delete();
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Response::json(array('deletedGroup' => false));
        }
        
        return Response::json(array('deletedGroup' => true));
    }
    
    /**
     * Remove user from group
     * @param int $groupId
     * @param int $userId
     * @return Response
     */
    public function deleteUserFromGroup($groupId, $userId)
    {
        try
        {
            $user = Sentry::getUserProvider()->findById($userId);
            $group = Sentry::getGroupProvider()->findById($groupId);
            $user->removeGroup($group);
            
            return Response::json(array('userDeleted' => true));
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Response::json(array('userDeleted' => false, 'errorMessage' => 'User does not exists !'));
        }
        catch(\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            return Response::json(array('userDeleted' => false, 'errorMessage' => 'Group does not exists !'));
        }
    }
    
    /**
     * Validate group informations
     * @param array $permissionsValues
     * @param string $groupname
     * @return array
     */
    protected function _validateGroup($permissionsValues, $groupname, &$permissions)
    {
        $errors = array();
        $permissionErrors = array();
        // validate permissions
        foreach($permissionsValues as $key => $permission)
        {
            $validPermission = Validator::make(array('permission' => $permission), Config::get('syntara::rules.groups.create_permission'));
            if($validPermission->fails())
            {
                $permissionErrors['permission['.$key.']'] = $validPermission->messages()->getMessages();
            }
            else
            {
               $permissions[$permission] = 1;
            }
        }
        // validate group name
        $validator = Validator::make(
            array('groupname' => $groupname),
            Config::get('syntara::rules.groups.create_name')
        );

        $gnErrors = array();
        if($validator->fails())
        {
            $gnErrors = $validator->messages()->getMessages();
        }
        
        $errors = array_merge($permissionErrors, $gnErrors);
        return $errors;
    }
}
