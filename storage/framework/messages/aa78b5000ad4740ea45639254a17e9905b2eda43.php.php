<?php

namespace App\Http\Controllers;

use App\Essay;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {
		$lastestEssays = self::lastestEssays();
		$lastestReview = self::lastestReview();
		return view('home', compact(['lastestEssays', 'lastestReview']))->with('i');
	}

	public function lastestEssays() {
		$rows = Essay::select('essay_title', 'student_name', 'created_at')
			->orderBy('id', 'desc')
			->take(5)
			->get();
		return $rows;
	}

	public function lastestReview() {
		$rows = Essay::select('essay_title', 'student_name', 'updated_at')
			->where('review_status', REVIEWED)
			->orderBy('updated_at', 'desc')
			->take(5)
			->get();
		return $rows;
	}

}
