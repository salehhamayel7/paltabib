<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailabilitisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availabilitis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doctor_id');
            $table->integer('clinic_id');
            $table->time('from');
            $table->time('to');
            $table->time('break_from');
            $table->time('break_to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availabilitis');
    }
}
