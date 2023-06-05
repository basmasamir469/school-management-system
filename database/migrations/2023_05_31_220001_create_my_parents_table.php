<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            //Fatherinformation
            $table->json('father_name');
            $table->string('father_national_id');
            $table->string('father_passport_id');
            $table->string('father_phone');
            $table->json('father_job');
            $table->bigInteger('father_nationality_id')->unsigned();
            $table->foreign('father_nationality_id')->references('id')->on('nationalities');
            $table->bigInteger('father_blood_type_id')->unsigned();
            $table->foreign('father_blood_type_id')->references('id')->on('blood_types');
            $table->bigInteger('father_religion_id')->unsigned();
            $table->foreign('father_religion_id')->references('id')->on('religions');
            $table->text('father_address');

            //Matherinformation
            $table->json('mather_name');
            $table->string('mather_national_id');
            $table->string('mather_passport_id');
            $table->string('mather_phone');
            $table->json('mather_job');
            $table->bigInteger('mather_nationality_id')->unsigned();
            $table->foreign('mather_nationality_id')->references('id')->on('nationalities');
            $table->bigInteger('mather_blood_type_id')->unsigned();
            $table->foreign('mather_blood_type_id')->references('id')->on('blood_types');
            $table->bigInteger('mather_religion_id')->unsigned();
            $table->foreign('mather_religion_id')->references('id')->on('religions');
            $table->text('mather_address');
            

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
        Schema::dropIfExists('my_parents');
    }
};
