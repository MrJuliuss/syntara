<?php namespace MrJuliuss\Syntara\Controllers;

use MrJuliuss\Syntara\Controllers\BaseController;
use MrJuliuss\Syntara\Services\Validators\Permission as PermissionValidator;
use PermissionProvider;
use View;
use Config;
use Input;
use Response;
use Request;
use URL;

class PermissionController extends BaseController 
{
    /**
    * List of permissions
    */
    public function getIndex()
    {
        $permissions = PermissionProvider::createModel();
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

        $permissions = $permissions->paginate(Config::get('syntara::config.item-perge-page'));

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('syntara::views.permissions-list'), array('permissions' => $permissions))->render();

            return Response::json(array('html' => $html));
        }

        $this->layout = View::make(Config::get('syntara::views.permissions-index'), array('permissions' => $permissions));
        $this->layout->title = trans('syntara::permissions.titles.list');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.permissions');
    }

    /**
     * Show new permission view
     */
    public function getCreate()
    {
        $this->layout = View::make(Config::get('syntara::views.permission-create'));
        $this->layout->title = trans('syntara::permissions.titles.new');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_permission');
    }

    /**
     * Create new permission
     */
    public function postCreate()
    {
        try
        {
            $validator = new PermissionValidator(Input::all());
            if(!$validator->passes())
            {
                return Response::json(array('permissionCreated' => false, 'errorMessages' => $validator->getErrors()));
            }

            // create permission
            $permission = PermissionProvider::createPermission(Input::all());
        }
        catch (\MrJuliuss\Syntara\Models\Permissions\NameRequiredException $e) {}
        catch (\MrJuliuss\Syntara\Models\Permissions\ValueRequiredException $e) {}
        catch (\MrJuliuss\Syntara\Models\Permissions\PermissionExistsException $e)
        {
            return json_encode(array('permissionCreated' => false, 'message' => trans('syntara::permissions.messages.exists'), 'messageType' => 'danger'));
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
            
            $this->layout = View::make(Config::get('syntara::views.permission-edit'), array(
                'permission' => $permission,
            ));
            $this->layout->title = 'Permission '.$permission->getName();
            $this->layout->breadcrumb = array(
                    array(
                        'title' => trans('syntara::breadcrumbs.permissions'),
                        'link' => URL::route('listPermissions'),
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
            $this->layout = View::make(Config::get('syntara::views.error'), array('message' => trans('syntara::permissions.messages.not-found')));
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
            $validator = new PermissionValidator(Input::all());
            if(!$validator->passes())
            {
                return Response::json(array('permissionUpdated' => false, 'errorMessages' => $validator->getErrors()));
            }

            // Find the permission using the permission id
            $permission = PermissionProvider::findById($permissionId);
            $permission->fill(Input::all());

            // Update the permission
            if($permission->save())
            {
                return Response::json(array('permissionUpdated' => true, 'message' => trans('syntara::permissions.messages.update-success'), 'messageType' => 'success'));
            }
            else 
            {
                return Response::json(array('permissionUpdated' => false, 'message' => trans('syntara::permissions.messages.update-fail'), 'messageType' => 'danger'));
            }
        }
        catch (\MrJuliuss\Syntara\Models\Permissions\PermissionExistsException $e)
        {
            return Response::json(array('permissionUpdated' => false, 'message' => trans('syntara::permissions.messages.exists'), 'messageType' => 'danger'));
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
            return Response::json(array('deletePermission' => false, 'message' => trans('syntara::permissions.messages.not-found'), 'messageType' => 'danger'));
        }

        return Response::json(array('deletePermission' => true, 'message' => trans('syntara::permissions.messages.remove-success'), 'messageType' => 'success'));
    }
}