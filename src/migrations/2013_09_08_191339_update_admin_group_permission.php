<?php

use Illuminate\Database\Migrations\Migration;
use MrJuliuss\Syntara\Facades\PermissionProvider;

class UpdateAdminGroupPermission extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('groups')
	        ->where('name', 'Admin')
            ->update(array('permissions' => json_encode(array('superuser' => 1))));
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