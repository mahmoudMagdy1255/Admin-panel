<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('destinations', function (Blueprint $table) {
			$table->increments('id');
			$table->string('image');
			$table->integer('parent_id')->unsigned()->nullable();
			$table->foreign('parent_id')->references('id')->on('destinations')->onDelete('cascade');

			$table->timestamps();
		});

		# Translation
		Schema::create('destination_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->longText('desc');
			$table->integer('destination_id')->unsigned()->nullable();
			$table->string('locale')->index();
			$table->unique(['destination_id', 'locale']);
			$table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('destinations');
		Schema::dropIfExists('destinations_translation');
	}
}
