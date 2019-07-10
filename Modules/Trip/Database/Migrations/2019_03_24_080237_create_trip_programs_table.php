<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripProgramsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('trip_programs', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('trip_id')->unsigned()->nullable();
			$table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
			$table->string('title');
			$table->longText('desc');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('trip_programs');
	}
}
