<?php 

namespace MrJuliuss\Syntara\Controllers;

use MrJuliuss\Syntara\Controllers\BaseController;
use PermissionProvider;
use View;
use Validator;
use Input;
use Config;
use Response;
use Sentry;
use Request;
use DB;
use URL;

class GroupController extends BaseController 
{
    /**
    * List of groups
    */
    public function getIndex()
    {
        $emptyGroup =  Sentry::getGroupProvider()->createModel();

        // Ajax search
        $groupId = Input::get('groupIdSearch');
        if(!empty($groupId))
        {
            $emptyGroup = $emptyGroup->where('id', $groupId);
        }
        $groupname = Input::get('groupnameSearch');
        if(!empty($groupname))
        {
            $emptyGroup = $emptyGroup->where('name', 'LIKE', '%'.$groupname.'%');
        }

        $groups = $emptyGroup->paginate(20);

        // ajax: reload only the content container
        if(Request::ajax())
        {
            $html = View::make('syntara::group.list-groups', array('groups' => $groups))->render();
            
            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make('syntara::group.index-group', array('groups' => $groups));
        $this->layout->title = "Groups list";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.groups');
    }
    
    /**
    * Show create group view
    */
    public function getCreate()
    {
        $permissions = PermissionProvider::findAll();

        $this->layout = View::make('syntara::group.new-group', array('permissions' => $permissions));
        $this->layout->title = "New group";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_group');
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
                // create group
                Sentry::getGroupProvider()->create(array(
                    'name' => $groupname,
                    'permissions' => $permissions,
                ));
            }
            catch (\Cartalyst\Sentry\Groups\NameRequiredException $e) {}
            catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
            {
                return Response::json(array('groupCreated' => false, 'message' => 'Group with this name already exists.', 'messageType' => 'danger'));
            }
        }

        return Response::json(array('groupCreated' => true,  'redirectUrl' => URL::route('listGroups')));
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

            $permissions = PermissionProvider::findAll();

            $groupPermissions = array();
            foreach($group->getPermissions() as $permissionValue => $key)
            {
                $p = PermissionProvider::findByValue($permissionValue);
                foreach($permissions as $key => $permission)
                {
                    if($p->getId() === $permission->getId())
                    {
                        $groupPermissions[] = $permission;
                        unset($permissions[$key]);
                    }
                }
            }

            $userids = array();
            foreach(Sentry::getUserProvider()->findAllInGroup($group) as $user) 
            {
                $userids[] = $user->id;
            }

            // get users in group
            $users = Sentry::getUserProvider()->createModel()->join('users_groups', 'users.id', '=', 'users_groups.user_id')->where('users_groups.group_id', '=', $group->getId())
                    ->paginate(20);

            // users not in group
            $candidateUsers = array();
            $allUsers = Sentry::getUserProvider()->findAll();
            foreach($allUsers as $user)
            {
                if(!$user->inGroup($group))
                {
                    $candidateUsers[] = $user;
                }
            }

            // ajax request : reload only content container
            if(Request::ajax())
            {
                $html = View::make('syntara::group.list-users-group', array('group' => $group, 'users' => $users, 'candidateUsers' => $candidateUsers))->render();
                
                return Response::json(array('html' => $html));
            }
            
            $this->layout = View::make('syntara::group.show-group', array('group' => $group, 'users' => $users, 'candidateUsers' => $candidateUsers, 'permissions' => $permissions, 'groupPermissions' => $groupPermissions));
            $this->layout->title = 'Group '.$group->getName();
            $this->layout->breadcrumb = array(
                array(
                    'title' => 'Groups', 
                    'link' => "dashboard/groups", 
                    'icon' => 'glyphicon-list-alt'
                ), 
                array(
                    'title' => $group->name, 
                    'link' => URL::current(), 
                    'icon' => ''
                )
            );
        }
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            $this->layout->content = View::make('syntara::dashboard.error', array('message' => 'Sorry, group not found !'));
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
                    return Response::json(array('groupUpdated' => true, 'message' => 'Group updated with success.', 'messageType' => 'success'));
                }
                else 
                {
                    return Response::json(array('groupUpdated' => false, 'message' => 'Can not update this group, please try again.', 'messageType' => 'danger'));
                }
            }
            catch (\Cartalyst\Sentry\Groups\NameRequiredException $e) {}
            catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
            {
                return Response::json(array('groupUpdated' => false, 'message' => 'Group with this name already exists.', 'messageType' => 'danger'));
            }
        }
    }
       
    /**
     * Delete group
     * @param  int $groupId
     * @return Response
     */
    public function delete($groupId)
    {
        try
        {
            $group = Sentry::getGroupProvider()->findById($groupId);
            $group->delete();
        }
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            return Response::json(array('deletedGroup' => false, 'message' => 'Group does not exists.', 'messageType' => 'danger'));
        }
        
        return Response::json(array('deletedGroup' => true, 'message' => "Group removed with success.", 'messageType' => 'success'));
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
            
            return Response::json(array('userDeleted' => true, 'message' => 'User removed from group with success.', 'messageType' => 'success'));
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Response::json(array('userDeleted' => false, 'message' => 'User does not exists.', 'messageType' => 'danger'));
        }
        catch(\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            return Response::json(array('userDeleted' => false, 'message' => 'Group does not exists.', 'messageType' => 'danger'));
        }
    }
    
    /**
     * Add a user in a group
     * @return Response
     */
    public function addUserInGroup()
    {
        try
        {
            $userId = Input::get('userId');
            $groupId = Input::get('groupId');

            $user = Sentry::getUserProvider()->findById($userId);
            $group = Sentry::getGroupProvider()->findById($groupId);
            $user->addGroup($group);

            return Response::json(array('userAdded' => true, 'message' => 'User added to the group with success.', 'messageType' => 'success'));
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Response::json(array('userAdded' => false, 'message' => 'User does not exists.', 'messageType' => 'danger'));
        }
        catch(\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            return Response::json(array('userAdded' => false, 'message' => 'Group does not exists.', 'messageType' => 'danger'));
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
        if(!empty($permissionsValues))
        {
            foreach($permissionsValues as $key => $permission)
            {
               $permissions[$key] = 1;
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
