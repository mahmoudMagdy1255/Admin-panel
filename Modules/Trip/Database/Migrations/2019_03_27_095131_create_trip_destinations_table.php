<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripDestinationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('trip_destinations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('destination_id')->unsigned();
			$table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');
			$table->integer('trip_id')->unsigned()->nullable();
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
		Schema::dropIfExists('trip_destinations');
	}
}
