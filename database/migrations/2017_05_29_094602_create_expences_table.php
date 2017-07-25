<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('expences', function (Blueprint $table) {

        $table->increments('id');
        $table->integer('value');
        $table->string('source');
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
        Schema::dropIfExists('expences');
    }
}
