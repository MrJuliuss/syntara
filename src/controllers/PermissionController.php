<?php namespace MrJuliuss\Syntara\Controllers;

use MrJuliuss\Syntara\Controllers\BaseController;
use Paginator;
use PermissionProvider;
use View;
use Config;

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
}