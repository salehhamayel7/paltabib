<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('doctors', function (Blueprint $table) {

         $table->increments('id');
         $table->string('user_name')->unique();
         $table->integer('salary')->default(0);
         $table->integer('clinic_id');
         $table->string('major')->default('major');
         $table->string('union_number')->default('0000000000');
       
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
        Schema::dropIfExists('doctors');
    }
}
