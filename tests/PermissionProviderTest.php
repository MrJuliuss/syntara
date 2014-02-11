<?php namespace MrJuliuss\Syntara\Tests;

use Mockery as m;
use MrJuliuss\Syntara\Models\Permissions\PermissionProvider;
use PHPUnit_Framework_TestCase;

class PermissionProviderTest extends PHPUnit_Framework_TestCase {

    /**
     * Close mockery.
     *
     * @return void
     */
    public function tearDown()
    {
        m::close();
    }

    public function testCreatePermission()
    {
        $attributes = array(
            'name' => 'Foo bar',
            'value' => 'Foo',
            'description' => 'Foo Bar'
        );

        $permission = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission');
        $permission->shouldReceive('hasGetMutator')->andReturn(false);
        $permission->shouldReceive('fill')->with($attributes)->once();
        $permission->shouldReceive('save')->once()->andReturn($permission);

        $provider = m::mock('MrJuliuss\Syntara\Models\Permissions\PermissionProvider[createModel]');
        $provider->shouldReceive('createModel')->once()->andReturn($permission);

        $this->assertEquals($permission, $provider->createPermission($attributes));
    }

    /**
     * @expectedException MrJuliuss\Syntara\Models\Permissions\ValueRequiredException
     */
    public function testCreatePermissionInvalidValue()
    {
        $attributes = array(
            'name' => 'Foo bar',
            'value' => '',
            'description' => 'Foo Bar'
        );

        $permission = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission');
        $permission->shouldReceive('hasGetMutator')->andReturn(false);
        $permission->shouldReceive('fill')->with($attributes)->once();
        $permission->shouldReceive('save')->once()->andThrow('MrJuliuss\Syntara\Models\Permissions\ValueRequiredException');

        $provider = m::mock('MrJuliuss\Syntara\Models\Permissions\PermissionProvider[createModel]');
        $provider->shouldReceive('createModel')->once()->andReturn($permission);

        $this->assertEquals($permission, $provider->createPermission($attributes));
    }

    /**
     * @expectedException MrJuliuss\Syntara\Models\Permissions\NameRequiredException
     */
    public function testCreatePermissionInvalidName()
    {
        $attributes = array(
            'name' => '',
            'value' => 'Foo',
            'description' => 'Foo Bar'
        );

        $permission = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission');
        $permission->shouldReceive('hasGetMutator')->andReturn(false);
        $permission->shouldReceive('fill')->with($attributes)->once();
        $permission->shouldReceive('save')->once()->andThrow('MrJuliuss\Syntara\Models\Permissions\NameRequiredException');

        $provider = m::mock('MrJuliuss\Syntara\Models\Permissions\PermissionProvider[createModel]');
        $provider->shouldReceive('createModel')->once()->andReturn($permission);

        $this->assertEquals($permission, $provider->createPermission($attributes));
    }

    /**
     * @expectedException MrJuliuss\Syntara\Models\Permissions\PermissionExistsException
     */
    public function testCreatePermissionThrowPermissionExists()
    {
        $attributes = array(
            'name' => 'Foo',
            'value' => 'Foo',
            'description' => 'Foo Bar'
        );

        $permission = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission');
        $permission->shouldReceive('hasGetMutator')->andReturn(false);
        $permission->shouldReceive('fill')->with($attributes)->once();
        $permission->shouldReceive('save')->once()->andThrow('MrJuliuss\Syntara\Models\Permissions\PermissionExistsException');

        $provider = m::mock('MrJuliuss\Syntara\Models\Permissions\PermissionProvider[createModel]');
        $provider->shouldReceive('createModel')->once()->andReturn($permission);

        $this->assertEquals($permission, $provider->createPermission($attributes));
    }

    public function testFindingById()
    {
        $provider = m::mock('MrJuliuss\Syntara\Models\Permissions\PermissionProvider[createModel]');
        
        $permission = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission');
        $permission->shouldReceive('hasGetMutator')->andReturn(false);

        $query = m::mock('StdClass');
        $query->shouldReceive('newQuery')->andReturn($query);
        $query->shouldReceive('find')->with(1)->once()->andReturn($permission);

        $provider->shouldReceive('createModel')->once()->andReturn($query);

        $this->assertEquals($permission, $provider->findById(1));
    }

    /**
     * @expectedException MrJuliuss\Syntara\Models\Permissions\PermissionNotFoundException
     */
    public function testFailedFindingByIdThrowsExceptionIfNotFound()
    {
        $provider = m::mock('MrJuliuss\Syntara\Models\Permissions\PermissionProvider[createModel]');

        $permission = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission');
        $permission->shouldReceive('hasGetMutator')->andReturn(false);

        $query = m::mock('StdClass');
        $query->shouldReceive('newQuery')->andReturn($query);
        $query->shouldReceive('find')->with(1)->once()->andReturn(null);

        $provider->shouldReceive('createModel')->once()->andReturn($query);

        $provider->findById(1);
    }

    public function testFindingByValue()
    {
        $provider = m::mock('MrJuliuss\Syntara\Models\Permissions\PermissionProvider[createModel]');

        $permission = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission');
        $permission->shouldReceive('hasGetMutator')->andReturn(false);

        $query = m::mock('StdClass');
        $query->shouldReceive('newQuery')->andReturn($query);
        $query->shouldReceive('where')->with('value', '=', 'superuser')->once()->andReturn($query);
        $query->shouldReceive('get')->once()->andReturn($query);
        $query->shouldReceive('first')->andReturn($permission);

        $provider->shouldReceive('createModel')->once()->andReturn($query);

        $this->assertEquals($permission, $provider->findByValue('superuser'));
    }

    /**
     * @expectedException MrJuliuss\Syntara\Models\Permissions\PermissionNotFoundException
     */
    public function testFindingByIdPermissionNotFoundException()
    {
        $provider = m::mock('MrJuliuss\Syntara\Models\Permissions\PermissionProvider[createModel]');

        $permission = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission');
        $permission->shouldReceive('hasGetMutator')->andReturn(false);

        $query = m::mock('StdClass');
        $query->shouldReceive('newQuery')->andReturn($query);
        $query->shouldReceive('where')->with('value', '=', 'superuser')->once()->andReturn($query);
        $query->shouldReceive('get')->once()->andReturn($query);
        $query->shouldReceive('first')->andReturn(null);

        $provider->shouldReceive('createModel')->once()->andReturn($query);

        $provider->findByValue('superuser');
    }

    public function testFindingAllPermissions()
    {
        $provider = m::mock('MrJuliuss\Syntara\Models\Permissions\PermissionProvider[createModel]');

        $provider->shouldReceive('createModel')->once()->andReturn($query = m::mock('StdClass'));

        $permission1 = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission')->shouldReceive('hasGetMutator')->andReturn(false);
        $permission2 = m::mock('MrJuliuss\Syntara\Models\Permissions\Permission')->shouldReceive('hasGetMutator')->andReturn(false);

        $query->shouldReceive('newQuery')->andReturn($query);
        $query->shouldReceive('get')->andReturn($query);
        $query->shouldReceive('all')->andReturn($permissions = array($permission1, $permission2));

        $this->assertEquals($permissions, $provider->findAll());
    }
}