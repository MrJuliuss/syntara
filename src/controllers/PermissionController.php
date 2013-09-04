<?php namespace MrJuliuss\Syntara\Controllers;

use MrJuliuss\Syntara\Controllers\BaseController;
use MrJuliuss\Syntara\Models\Permissions\Permission;
use Paginator;
use PermissionProvider;
use View;
use Config;
use Input;
use Response;
use Request;
use Validator;
use URL;

class PermissionController extends BaseController 
{
    /**
    * List of permissions
    */
    public function getIndex()
    {
        $permissions = new Permission;

        $permissionId = Input::get('permissionIdSearch');
        if(!empty($permissionId))
        {
            $permissions = $permissions->where('id', $permissionId);
        }
        $permissionName = Input::get('permissionNameSearch');
        if(!empty($permissionName))
        {
            $permissions = $permissions->where('name', 'LIKE', '%'.$permissionName.'%');
        }
        $permissionValue = Input::get('permissionValueSearch');
        if(!empty($permissionValue))
        {
            $permissions = $permissions->where('value', 'LIKE', '%'.$permissionValue.'%');
        }

        $permissions = $permissions->paginate(20);

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make('syntara::permission.list-permissions', array('permissions' => $permissions))->render();
            
            return Response::json(array('html' => $html));
        }

        $this->layout = View::make('syntara::permission.index-permission', array('permissions' => $permissions));
        $this->layout->title = "Permissions list";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.permissions');
    }

    /**
     * Show new permission view
     */
    public function getCreate()
    {
        $this->layout = View::make('syntara::permission.new-permission');
        $this->layout->title = "New permission";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_permission');
    }

    /**
     * Create new permission
     */
    public function postCreate()
    {
        try
        {
            $validator = Validator::make(
                Input::all(),
                Config::get('syntara::rules.permissions.create')
            );

            if($validator->fails())
            {
                return Response::json(array('permissionCreated' => false, 'errorMessages' => $validator->messages()->getMessages()));
            }

            // create permission
            $permission = PermissionProvider::createPermission(Input::all());
        }
        catch (\MrJuliuss\Syntara\Models\Permissions\NameRequiredException $e) {}
        catch (\MrJuliuss\Syntara\Models\Permissions\ValueRequiredException $e) {}
        catch (\MrJuliuss\Syntara\Models\Permissions\PermissionExistsException $e)
        {
            return json_encode(array('permissionCreated' => false, 'message' => 'Permission with this value already exists.', 'messageType' => 'danger'));
        }

        return json_encode(array('permissionCreated' => true, 'redirectUrl' => URL::route('listPermissions')));
    }

    /**
    * View permission
    * @param int $permissionId
    */
    public function getShow($permissionId)
    {
        try
        {
            $permission = PermissionProvider::findById($permissionId);
            
            $this->layout = View::make('syntara::permission.show-permission', array(
                'permission' => $permission,
            ));
            $this->layout->title = 'Permission '.$permission->getName();
            $this->layout->breadcrumb = array(
                    array(
                        'title' => 'Permissions',
                        'link' => "dashboard/permissions",
                        'icon' => 'glyphicon-ban-circle'
                    ),
                    array(
                     'title' => $permission->getName(),
                     'link' => URL::current(),
                     'icon' => ''
                    )
            );
        }
        catch (\MrJuliuss\Syntara\Models\Permissions\PermissionNotFoundException $e)
        {
            $this->layout = View::make('syntara::dashboard.error', array('message' => 'Sorry, permission not found ! '));
        }
    }

    /**
    * Update permission
    * @param int $permissionId
    * @return Response
    */
    public function putShow($permissionId)
    {
        try
        {
            $validator = Validator::make(
                Input::all(),
                Config::get('syntara::rules.permissions.create')
            );
            if($validator->fails())
            {
                return Response::json(array('permissionUpdated' => false, 'errorMessages' => $validator->messages()->getMessages()));
            }

            // Find the permission using the permission id
            $permission = PermissionProvider::findById($permissionId);
            $permission->fill(Input::all());

            // Update the permission
            if($permission->save())
            {
                return Response::json(array('permissionUpdated' => true, 'message' => 'Permission has been updated with success.', 'messageType' => 'success'));
            }
            else 
            {
                return Response::json(array('permissionUpdated' => false, 'message' => 'Can not update this permission, please try again.', 'messageType' => 'danger'));
            }
        }
        catch (\MrJuliuss\Syntara\Models\Permissions\PermissionExistsException $e)
        {
            return Response::json(array('permissionUpdated' => false, 'message' => 'A permission with this value already exists.', 'messageType' => 'danger'));
        }
    }

    /**
    * Delete a permission
    */
    public function delete($permissionId)
    {
        try
        {
            $permission = PermissionProvider::findById($permissionId);
            $permission->delete();
        }
        catch (\MrJuliuss\Syntara\Models\Permissions\PermissionNotFoundException $e)
        {
            return Response::json(array('deletePermission' => false, 'message' => 'Permission does not exists.', 'messageType' => 'danger'));
        }

        return Response::json(array('deletePermission' => true, 'message' => 'Permission removed with success.', 'messageType' => 'success'));
    }
}