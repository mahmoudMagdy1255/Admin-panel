<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_program', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trip_id')->unsigned()->nullable();
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('set null');
            $table->timestamps();
        });


        # Translation
        Schema::create('trip_program_trans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->integer('trip_program_id')->unsigned()->nullable();
            $table->string('locale')->index();
            $table->unique(['trip_program_id', 'locale']);
            $table->foreign('trip_program_id')->references('id')->on('trip_program')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_program');
        Schema::dropIfExists('trip_program_trans');
    }
}
