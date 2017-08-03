<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('bills', function (Blueprint $table) {

        $table->increments('id');
        $table->string('pacient_id');
        $table->string('doctor_id');
        $table->string('currency')->default("USD");
        $table->integer('value');
        $table->integer('paid_value');
        $table->string('source')->nullable();
        $table->unsignedInteger('clinic_id');
        $table->string('description');
        $table->timestamps();
      });

      
        
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
