<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstrainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('secretaries', function (Blueprint $table) {
            $table->primary('user_name');
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->primary('user_name');
        });

        Schema::table('nurses', function (Blueprint $table) {
            $table->primary('user_name');
        });

        Schema::table('pacients', function (Blueprint $table) {
            $table->primary('user_name');
        });

        Schema::table('secretaries', function($table) {
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

         Schema::table('doctors', function($table) {
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

         Schema::table('nurses', function($table) {
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('pacients', function($table) {
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });


         Schema::table('events', function($table) {
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade')->onUpdate('cascade');
        });

         Schema::table('appointments', function($table) {
            $table->foreign('doctor_id')->references('user_name')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pacient_id')->references('user_name')->on('pacients')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('bills', function($table) {
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('expences', function($table) {
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade')->onUpdate('cascade');
        });

       
        Schema::table('users', function($table) {
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('messages', function($table) {
            $table->foreign('sender_id')->references('user_name')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('receiver_id')->references('user_name')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('receipts', function($table) {
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('patient_clinic', function($table) {
            $table->foreign('patient_id')->references('user_name')->on('pacients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('histories', function($table) {
            $table->foreign('patient_id')->references('user_name')->on('pacients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('doctor_id')->references('user_name')->on('doctors')->onDelete('cascade')->onUpdate('cascade');
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
    }
}
