<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('trips', function (Blueprint $table) {
			$table->increments('id');
			$table->string('image');
			$table->string('price');
			$table->longText('desc');
			$table->string('title');
			$table->integer('days')->unsigned();
			$table->longText('not_include')->nullable();
			$table->longText('include')->nullable();
			$table->longText('note')->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('trips');
	}
}
