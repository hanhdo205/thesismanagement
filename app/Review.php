<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'topic_id', 'user_id', 'review_status', 'review_token',
	];
}
