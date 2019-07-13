<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('configs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('logo')->nullable();
			$table->string('background')->nullable();
			$table->string('phone')->nullable();
			$table->timestamps();
		});

		Schema::create('config_translations', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('config_id')->unsigned();
			$table->foreign('config_id')->references('id')->on('configs')->onDelete('cascade');
			$table->string('title')->nullable();
			$table->string('desc')->nullable();
			$table->string('locale')->index();
			$table->unique(['config_id', 'locale']);
			$table->string('address')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('configs');
		Schema::dropIfExists('config_translations');
	}
}
