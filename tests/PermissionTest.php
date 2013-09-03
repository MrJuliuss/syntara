<?php namespace MrJuliuss\Syntara\Tests;

use MrJuliuss\Syntara\Models\Permissions\Permission;

class PermissionTest extends \TestCase
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
        $permission = new Permission;
        $permission->name = 'List users';
        $permission->value = 'view-users-list';
        $permission->validate();
    }

    public function testValidationPermission()
    {
        $permission = new Permission;
        $permission->name = 'New Foo';
        $permission->value = 'new-foo-bar';
        $permission->description = 'New Foo Bar description';
        $validated = $permission->validate();

        $this->assertTrue($validated);
    }

}