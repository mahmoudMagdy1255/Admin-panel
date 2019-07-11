<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripImagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('trip_images', function (Blueprint $table) {
			$table->increments('id');
			$table->string('image');
			$table->string('size');
			$table->string('mime_type');
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
		Schema::dropIfExists('trip_albums');
	}
}
