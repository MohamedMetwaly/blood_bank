<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->date('d_o_b');
			$table->integer('city_id')->unsigned()->nullable();
			$table->string('phone');
			$table->string('password');
			$table->integer('blood_type_id')->unsigned()->nullable();
			$table->date('donation_last_date');
			$table->integer('pin_code')->nullable();
			$table->string('api_token',60)->unique()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}