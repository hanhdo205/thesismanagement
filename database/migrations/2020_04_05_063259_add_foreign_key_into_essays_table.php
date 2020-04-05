<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyIntoEssaysTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('essays', function (Blueprint $table) {
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
		Schema::table('essays', function (Blueprint $table) {
			$table->dropForeign('essays_topic_id_foreign');
			$table->dropForeign('essays_reviewer_id_foreign');
		});
	}
}
