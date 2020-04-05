<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Essay extends Model {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'essay_title', 'essay_file', 'student_name', 'student_gender', 'student_dob', 'student_email', 'topic_id', 'reviewer_id', 'review_result', 'review_status',
	];
}
