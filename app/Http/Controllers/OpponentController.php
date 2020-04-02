<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Topic;
use App\User;
use Illuminate\Http\Request;

class OpponentController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	function __construct() {
		$this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
		$this->middleware('permission:user-create', ['only' => ['create', 'store']]);
		$this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
		$this->middleware('permission:user-delete', ['only' => ['destroy']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$topics = Topic::pluck('title', 'id')->all();
		$data = User::orderBy('id', 'DESC')->paginate(5);
		return view('opponents.index', compact(['data', 'topics']))
			->with('i', ($request->input('page', 1) - 1) * 5);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function confirmation(Request $request) {
		$topic = $request->input('topic');
		$checkboxs = $request->input('opponents');
		$opponents = User::whereIn('id', $checkboxs)->pluck('name', 'id');
		return view('opponents.confirmation', compact(['topic', 'opponents', 'checkboxs']));
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Topic  $topic
	 * @return \Illuminate\Http\Response
	 */
	public function send(Request $request) {
		return view('opponents.send');
	}
}
