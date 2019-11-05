<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientPostTable extends Migration {

	public function up()
	{
		Schema::create('client_post', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('post_id')->unsigned()->nullable();
			$table->integer('client_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('client_post');
	}
}