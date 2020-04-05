<?php

namespace App\Http\Controllers;

use App\Essay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class EssayController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	function __construct() {
		/*$this->middleware('permission:essay-list|essay-create|essay-edit|essay-delete', ['only' => ['index', 'show']]);
			$this->middleware('permission:essay-create', ['only' => ['create', 'store']]);
			$this->middleware('permission:essay-edit', ['only' => ['edit', 'update']]);
		*/
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Essay  $essay
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
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