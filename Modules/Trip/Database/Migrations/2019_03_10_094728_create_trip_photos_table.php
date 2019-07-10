<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripPhotosTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('trip_photos', function (Blueprint $table) {
			$table->increments('id');
			$table->string('photo');
			$table->integer('trip_id')->unsigned();
			$table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('trip_photos');
	}
}