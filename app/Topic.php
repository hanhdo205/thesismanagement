<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title', 'start_date', 'end_date',
	];
}
