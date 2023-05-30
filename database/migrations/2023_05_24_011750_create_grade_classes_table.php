<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeClassesTable extends Migration {

	public function up()
	{
		Schema::create('grade_classes', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->json('class_name');
			$table->integer('grade_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('grade_classes');
	}
}