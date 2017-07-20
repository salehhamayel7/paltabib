<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('clinics', function (Blueprint $table) {

         $table->unsignedInteger('id');
         $table->string('name');
         $table->string('phone');
         $table->string('address')->default("--");
         $table->string('manager_id')->nullable();
         $table->string('reg_proof')->default("id_template.png");
         $table->boolean('banned')->default(0);
         $table->timestamps();

      });

        Schema::table('clinics', function (Blueprint $table) {
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinics');
    }
}
