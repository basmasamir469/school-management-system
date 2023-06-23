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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->bigInteger('from_grade_id')->unsigned();
            $table->foreign('from_grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->bigInteger('from_class_id')->unsigned();
            $table->foreign('from_class_id')->references('id')->on('grade_classes')->onDelete('cascade');
            $table->bigInteger('from_section_id')->unsigned();
            $table->foreign('from_section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->bigInteger('to_grade_id')->unsigned();
            $table->foreign('to_grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->bigInteger('to_class_id')->unsigned();
            $table->foreign('to_class_id')->references('id')->on('grade_classes')->onDelete('cascade');
            $table->bigInteger('to_section_id')->unsigned();
            $table->foreign('to_section_id')->references('id')->on('sections')->onDelete('cascade');

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
        Schema::dropIfExists('promotions');
    }
};
