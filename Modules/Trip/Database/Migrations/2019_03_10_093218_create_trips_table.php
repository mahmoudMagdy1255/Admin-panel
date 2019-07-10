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
			$table->text('not_include')->nullable();
			$table->text('include')->nullable();
			$table->text('note')->nullable();
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
