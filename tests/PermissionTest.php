<?php namespace MrJuliuss\Syntara\Tests;

use Mockery as m;
use MrJuliuss\Syntara\Models\Permissions\Permission;
use PHPUnit_Framework_TestCase;

class PermissionTest extends PHPUnit_Framework_TestCase
{
    public function testPermissionIdCallsIdAttribute()
    {
        $permission = new Permission;
        $permission->id = 42;

        $this->assertEquals(42, $permission->getId());
    }

    public function testPermissionNameCallsNameAttribute()
    {
        $permission = new Permission;
        $permission->name = 'Foo';

        $this->assertEquals('Foo', $permission->getName());
    }

    public function testPermissionValueCallsValueAttribute()
    {
        $permission = new Permission;
        $permission->value = 'foo-bar';

        $this->assertEquals('foo-bar', $permission->getValue());
    }

    public function testPermissionDescriptionCallsDescriptionAttribute()
    {
        $permission = new Permission;
        $permission->description = 'Foo Bar !';

        $this->assertEquals('Foo Bar !', $permission->getDescription());
    }

    /**
     * @expectedException MrJuliuss\Syntara\Models\Permissions\NameRequiredException
     */
    public function testValidationThrowsNameRequiredExceptionIfNoneGiven()
    {
        $permission = new Permission;
        $permission->validate();
    }

    /**
     * @expectedException MrJuliuss\Syntara\Models\Permissions\ValueRequiredException
     */
    public function testValidationThrowsValueRequiredException()
    {
        $permission = new Permission;
        $permission->name = 'Yeepah';
        $permission->validate();
    }

    /**
     * @expectedException MrJuliuss\Syntara\Models\Permissions\PermissionExistsException
     */
    public function testValidationThrowsPermissionExistsException()
    {
        $persistedPermission = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission');
        $persistedPermission->shouldReceive('hasGetMutator')->andReturn(false);
        $persistedPermission->shouldReceive('getId')->once()->andReturn(42);

        $permission = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission[newQuery]');
        $permission->id = 43;
        $permission->name = 'List users';
        $permission->value = 'view-users-list';

        $query = m::mock('StdClass');
        $query->shouldReceive('where')->with('value', '=', 'view-users-list')->once()->andReturn($query);
        $query->shouldReceive('first')->once()->andReturn($persistedPermission);

        $permission->shouldReceive('newQuery')->once()->andReturn($query);

        $permission->validate();
    }

    public function testValidationPermission()
    {
        $persistedPermission = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission');
        $persistedPermission->shouldReceive('hasGetMutator')->andReturn(false);
        $persistedPermission->shouldReceive('getId')->once()->andReturn(43);

        $permission = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission[newQuery]');
        $permission->id = 43;
        $permission->name = 'List users';
        $permission->value = 'view-users-list';

        $query = m::mock('StdClass');
        $query->shouldReceive('where')->with('value', '=', 'view-users-list')->once()->andReturn($query);
        $query->shouldReceive('first')->once()->andReturn($persistedPermission);

        $permission->shouldReceive('newQuery')->once()->andReturn($query);

        $this->assertTrue($permission->validate());
    }

}