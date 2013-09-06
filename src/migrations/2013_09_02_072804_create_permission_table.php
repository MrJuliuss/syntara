<?php

use Illuminate\Database\Migrations\Migration;
use MrJuliuss\Syntara\Facades\PermissionProvider;

class CreatePermissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permissions', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 100);
		    $table->string('value', 100)->unique();
		    $table->string('description');
		    $table->timestamps();
		});

		PermissionProvider::createPermission(array('name' => 'Super User', 'value' => 'superuser', 'description' => 'All permissions'));
		PermissionProvider::createPermission(array('name' => 'List Users', 'value' => 'view-users-list', 'description' => 'View the list of users'));
		PermissionProvider::createPermission(array('name' => 'Create user', 'value' => 'create-user', 'description' => 'Create new user'));
		PermissionProvider::createPermission(array('name' => 'Delete user', 'value' => 'delete-user', 'description' => 'Delete a user'));
		PermissionProvider::createPermission(array('name' => 'Update user', 'value' => 'update-user-info', 'description' => 'Update a user profile'));
		PermissionProvider::createPermission(array('name' => 'Update user group', 'value' => 'user-group-management', 'description' => 'Add/Remove a user in a group'));
		PermissionProvider::createPermission(array('name' => 'Groups management', 'value' => 'groups-management', 'description' => 'Manage group (CRUD)'));
		PermissionProvider::createPermission(array('name' => 'Permissions management', 'value' => 'permissions-management', 'description' => 'Manage permissions (CRUD)'));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}