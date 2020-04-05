<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEssaysTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('essays', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('essay_title');
			$table->string('essay_file');
			$table->string('student_name');
			$table->char('student_gender', 6);
			$table->string('student_dob');
			$table->string('student_email');
			$table->smallInteger('review_result')->nullable();
			$table->smallInteger('review_status')->nullable();
			$table->timestamps();

		});
		Schema::table('essays', function (Blueprint $table) {
			$table->bigInteger('topic_id')->unsigned();
			$table->bigInteger('reviewer_id')->unsigned()->nullable();
			$table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
			$table->foreign('reviewer_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('essays');
	}
}
