<?php namespace MrJuliuss\Syntara\Controllers;

use MrJuliuss\Syntara\Controllers\BaseController;
use Paginator;
use PermissionProvider;
use View;
use Config;
use Input;
use Response;

class PermissionController extends BaseController 
{
    /**
    * List of permissions
    */
    public function getIndex()
    {
        $permissions = PermissionProvider::findAll();

        $permissionsPaginator = Paginator::make($permissions, count($permissions), 20);
        
        $this->layout = View::make('syntara::permission.index-permission', array('permissions' => $permissionsPaginator));
        $this->layout->title = "Permissions list";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.permissions');
    }

    /**
    * Delete a permission
    */
    public function delete()
    {
        try
        {
            $permissionId = Input::get('permissionId');
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