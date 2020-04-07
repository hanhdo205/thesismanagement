<?php

namespace App\Http\Controllers;

use App\Essay;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class EssayController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	function __construct() {
		//$this->middleware('permission:essay-list|essay-create|essay-edit|essay-delete', ['only' => ['index', 'show']]);
		//$this->middleware('permission:essay-create', ['only' => ['create', 'store']]);
		//$this->middleware('permission:essay-edit', ['only' => ['edit', 'update']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$topics = Topic::whereDate('end_date', '>', NOW())->orderBy('id', 'desc')->pluck('title', 'id');
		$last_topic_id = array_key_first($topics->toArray());
		$essays = self::essayList($last_topic_id);
		return view('essays.index', compact(['essays', 'topics', 'last_topic_id']))
			->with('i', ($request->input('page', 1) - 1) * 5);
	}

	public function essayList($topic_id) {
		$rows = DB::table('essays')
			->join('topics', 'essays.topic_id', '=', 'topics.id')
			->where('essays.topic_id', $topic_id)
			->paginate(5);
		return $rows;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function createEssay(Request $request) {
		$id = $request->id;
		$topic = Topic::where('id', $id)->first();
		if (empty($topic)) {
			return abort(404);
		}
		return view('detail', compact('topic'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function storeEssay(Request $request) {
		request()->validate([
			'essay_title' => 'required',
			//'essay_file' => 'required|mimes:doc,docx,pdf,txt|max:2048',
			'essay_file' => 'required',
			'student_name' => 'required',
			'student_gender' => 'required',
			'student_dob' => 'required',
			'student_email' => 'required',
		]);

		$path = $request->file('essay_file')->store('essays');
		Essay::create([
			'topic_id' => $request->input('topic_id'),
			'essay_title' => $request->input('essay_title'),
			'student_name' => $request->input('student_name'),
			'student_gender' => $request->input('student_gender'),
			'student_dob' => $request->input('student_dob'),
			'student_email' => $request->input('student_email'),
			'essay_file' => $path,
		]);

		return back()
			->with('success', _i('Registration successfully.'));
	}
}