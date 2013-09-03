<?php namespace MrJuliuss\Syntara\Tests;

use MrJuliuss\Syntara\Models\Permissions\PermissionProvider;
use MrJuliuss\Syntara\Models\Permissions\Permission;

class PermissionProviderTest extends \TestCase
{
    public function testCreatePermission()
    {
        $permissionData = array(
            'name' => 'Foo bar',
            'value' => 'test-foo',
            'description' => 'Foo Bar'
        );
        $permission = \PermissionProvider::createPermission($permissionData);

        $this->assertEquals($permission, Permission::where('value', '=', 'test-foo')->get()->first());
    }

    /**
     * @expectedException MrJuliuss\Syntara\Models\Permissions\PermissionExistsException
     */
    public function testCreatePermissionExistsException()
    {
        $permissionData = array(
            'name' => 'List users',
            'value' => 'view-users-list',
            'description' => 'List all users'
        );
        $permission = \PermissionProvider::createPermission($permissionData);
    }

    public function testFindingById()
    {
        $permission = \PermissionProvider::findById(1);

        $this->assertEquals($permission, Permission::where('id', '=', 1)->get()->first());
    }

    /**
     * @expectedException MrJuliuss\Syntara\Models\Permissions\PermissionNotFoundException
     */
    public function testFindingByIdPermissionNotFoundException()
    {
        $permission = \PermissionProvider::findById(1500);
    }

    public function testFindingByValue()
    {
        $permission = \PermissionProvider::findByValue('view-users-list');

        $this->assertEquals($permission, Permission::where('value', '=','view-users-list')->get()->first());
    }

    /**
     * @expectedException MrJuliuss\Syntara\Models\Permissions\PermissionNotFoundException
     */
    public function testFindingByValuePermissionNotFoundException()
    {
        $permission = \PermissionProvider::findByValue('foo-bar');
    }

    public function testFindingAllPermissions()
    {
        $permissions = \PermissionProvider::findAll();

        $this->assertEquals($permissions, Permission::query()->get()->all());
    }
}