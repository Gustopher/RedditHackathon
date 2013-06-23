<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTableAddUsernameAndAge extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{

			$table->string('username', 18);
			$table->integer('age', 3);

			// We'll need to ensure that MySQL uses the InnoDB engine to
			// support the indexes, other engines aren't affected.
			$table->engine = 'InnoDB';
			$table->unique('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
			$table->increments('id');
			$table->string('email');
			$table->string('password');
			$table->text('permissions')->nullable();
			$table->boolean('activated')->default(0);
			$table->string('activation_code')->nullable();
			$table->timestamp('activated_at')->nullable();
			$table->timestamp('last_login')->nullable();
			$table->string('persist_code')->nullable();
			$table->string('reset_password_code')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->timestamps();

			// We'll need to ensure that MySQL uses the InnoDB engine to
			// support the indexes, other engines aren't affected.
			$table->engine = 'InnoDB';
			$table->unique('email');
		});
	}

}