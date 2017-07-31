<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymenMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('description1');
            $table->string('description2');
            $table->string('description3');
            $table->string('description4');
            $table->string('description5');
            $table->string('method');
            $table->string('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('payment_methods');
    }
}
