<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table)
        {
            $table->string('gender');
            $table->string('user_name')->unique();
            $table->string('role');
            $table->string('phone');
            $table->string('address')->default("--");
            $table->unsignedInteger('clinic_id')->nullable();
            $table->string('image')->default("User_Avatar-512.png");
            $table->string('id_image')->default("id_template.png");
           
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
         Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('gender');
        $table->dropColumn('user_name');
        $table->dropColumn('role');
        $table->dropColumn('image');
        $table->dropColumn('address');
        $table->dropColumn('phone');
         });
       
    }
}
