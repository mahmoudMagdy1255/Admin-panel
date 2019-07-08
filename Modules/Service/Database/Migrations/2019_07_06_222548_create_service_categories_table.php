<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCategoriesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('service_categories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('image')->default('default.png');
			$table->bigInteger('parent_id')->unsigned()->nullable();
			$table->timestamps();
		});

		Schema::create('service_category_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('service_category_id')->unsigned();
			$table->string('title');
			$table->string('desc');
			$table->string('locale')->index();
			$table->unique(['service_category_id', 'locale']);
			$table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('service_categories');
	}
}
