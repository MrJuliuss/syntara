<?php namespace MrJuliuss\Syntara\Controllers;

use View;
use Validator;
use Input;
use Config;
use Response;
use Sentry;
use Request;

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
        $permissionErrors = array();
        $permissions = array();

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
}
