<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripCategoryTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('trip_category', function (Blueprint $table) {
			$table->increments('id');
			$table->string('image')->default('default.png');
			$table->integer('parent_id')->unsigned()->nullable();
			$table->foreign('parent_id')->references('id')->on('trip_category')->onDelete('cascade');
			$table->timestamps();
		});

		Schema::create('trip_category_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('trip_category_id')->unsigned()->nullable();
			$table->string('title');
			$table->longText('desc');
			$table->string('locale')->index();
			$table->unique(['trip_category_id', 'locale']);
			$table->foreign('trip_category_id')->references('id')->on('trip_category')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('trip_category');
		Schema::dropIfExists('trip_category_translations');
	}
}
