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
			$table->id();
			$table->string('essay_title');
			$table->string('essay_file');
			$table->string('student_name');
			$table->char('student_gender', 6);
			$table->string('student_dob');
			$table->string('student_email');
			$table->bigInteger('topic_id')->unsigned();
			$table->bigInteger('reviewer_id')->unsigned()->nullable();
			$table->char('review_result', 10)->default('fresh');
			$table->text('review_comment')->nullable();
			$table->char('review_status', 10)->default('pending');
			$table->timestamps();
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
