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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->json('student_name');
            $table->string('email');
            $table->string('password');
            $table->bigInteger('grade_id')->unsigned();
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->bigInteger('grade_class_id')->unsigned();
            $table->foreign('grade_class_id')->references('id')->on('grade_classes')->onDelete('cascade');
            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->bigInteger('parent_id')->unsigned();
            $table->foreign('parent_id')->references('id')->on('my_parents')->onDelete('cascade');
            $table->bigInteger('gender_id')->unsigned();
            $table->foreign('gender_id')->references('id')->on('genders');
            // $table->bigInteger('religion_id')->unsigned();
            // $table->foreign('religion_id')->references('id')->on('religions');
            $table->bigInteger('blood_type_id')->unsigned();
            $table->foreign('blood_type_id')->references('id')->on('blood_types');
            $table->date('birth_date');
            $table->string('academic_year');
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
        Schema::dropIfExists('students');
    }
};
