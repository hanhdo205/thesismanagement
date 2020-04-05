<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	function __construct() {
		$this->middleware('permission:topic-list|topic-create|topic-edit|topic-delete', ['only' => ['index', 'show']]);
		$this->middleware('permission:topic-create', ['only' => ['create', 'store']]);
		$this->middleware('permission:topic-edit', ['only' => ['edit', 'update']]);
		$this->middleware('permission:topic-delete', ['only' => ['destroy']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$topics = Topic::latest()->paginate(5);
		return view('topics.index', compact('topics'))
			->with('i', (request()->input('page', 1) - 1) * 5);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('topics.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		request()->validate([
			'title' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
		]);

		Topic::create($request->all());

		return redirect()->route('topics.index')
			->with('success', 'Topic created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Topic  $topic
	 * @return \Illuminate\Http\Response
	 */
	public function show(Topic $topic) {
		return view('topics.show', compact('topic'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Topic  $topic
	 * @return \Illuminate\Http\Response
	 */
	public function registerEssay(Request $request) {
		$id = $request->id;
		$topic = Topic::where('id', $id)->first();
		return view('detail', compact('topic'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Topic  $topic
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Topic $topic) {
		return view('topics.edit', compact('topic'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Topic  $topic
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Topic $topic) {
		request()->validate([
			'title' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
		]);

		$topic->update($request->all());

		return redirect()->route('topics.index')
			->with('success', 'Topic updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Topic  $topic
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Topic $topic) {
		$topic->delete();
		return redirect()->route('topics.index')
			->with('success', 'Topic deleted successfully');
	}
}