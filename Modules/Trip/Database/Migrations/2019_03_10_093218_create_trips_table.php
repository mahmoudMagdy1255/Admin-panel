<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo')->nullable();
            $table->string('price')->nullable();
            $table->integer('is_active')->default(1);

            $table->timestamps();
        });

        Schema::create('trips_translation', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trip_id')->unsigned()->nullable();
            $table->longText('description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->text('not_include')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('include')->nullable();
            $table->string('slug')->nullable();
            $table->string('locale')->index();
            $table->text('note')->nullable();
            $table->string('title')->nullable();

            $table->unique(['trip_id', 'locale']);
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
        Schema::dropIfExists('trips_translation');
    }
}
