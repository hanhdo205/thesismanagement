<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyIntoOpponentsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('reviews', function (Blueprint $table) {
			$table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('reviews', function (Blueprint $table) {
			$table->dropForeign('reviews_topic_id_foreign');
			$table->dropForeign('reviews_user_id_foreign');
		});
	}
}
