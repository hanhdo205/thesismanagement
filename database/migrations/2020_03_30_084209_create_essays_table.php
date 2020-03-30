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
			$table->bigInteger('topic_id');
			$table->bigInteger('reviewer_id');
			$table->string('title');
			$table->string('student');
			$table->smallInteger('result');
			$table->smallInteger('status');
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
