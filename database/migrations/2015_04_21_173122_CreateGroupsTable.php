<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function($table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('location', 255);
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->integer('area')->nullable();
            $table->string('frequency')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('groups');
	}

}
