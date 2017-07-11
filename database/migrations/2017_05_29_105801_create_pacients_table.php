<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name')->unique();
            $table->string('ensurance_number')->default('000000000');
            $table->string('job')->default('Job');;
            $table->text('social_history')->nullable();
            $table->text('family_history')->nullable();
            $table->text('past_history')->nullable();
            $table->text('demo_details')->nullable();
            $table->text('systematic_en')->nullable();
            $table->text('cardio_system')->nullable();
            $table->text('respiratory_system')->nullable();
            $table->text('on_exam')->nullable();
            $table->text('present_comp')->nullable();
            $table->text('history_of_comp')->nullable();
            $table->text('drug_history')->nullable();
           
            $table->boolean('married')->default(0);
            $table->boolean('allergic')->default(0);
            $table->boolean('smoking')->default(0);
            $table->boolean('alcohol')->default(0);
            $table->boolean('drugs')->default(0);
            $table->boolean('disability')->default(0);
            $table->string('allergic_from')->nullable();
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
        Schema::dropIfExists('pacients');
    }
}
