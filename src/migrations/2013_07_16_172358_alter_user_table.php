<?php

use Illuminate\Database\Migrations\Migration;

class AlterUserTable extends Migration 
{

    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->string('username')->after('email');
            $table->unique('username');
        });
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