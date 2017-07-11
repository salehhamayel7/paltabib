<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('appointments', function (Blueprint $table) {

            $table->increments('id');
            $table->date('date');
            $table->string('color')->nullable();
            $table->string('doctor_id');
            $table->string('title');
            $table->time('time');
            $table->string('pacient_id');
            $table->integer('clinic_id');
            $table->boolean('is_approved')->default(0);
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
        Schema::dropIfExists('appointments');
    }
}
