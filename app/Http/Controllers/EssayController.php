<?php

namespace App\Http\Controllers;

use App\Essay;
use Illuminate\Http\Request;

class EssayController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	function __construct() {
		$this->middleware('permission:essay-list|essay-create|essay-edit|essay-delete', ['only' => ['index', 'show']]);
		$this->middleware('permission:essay-create', ['only' => ['create', 'store']]);
		$this->middleware('permission:essay-edit', ['only' => ['edit', 'update']]);
		$this->middleware('permission:essay-delete', ['only' => ['destroy']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$essays = Essay::latest()->paginate(5);
		return view('essays.index', compact('essays'))
			->with('i', (request()->input('page', 1) - 1) * 5);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('essays.create');
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
			'period' => 'required',
			'status' => 'required',
		]);

		Essay::create($request->all());

		return redirect()->route('essays.index')
			->with('success', 'Essay created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Essay  $essay
	 * @return \Illuminate\Http\Response
	 */
	public function show(Essay $essay) {
		return view('essays.show', compact('essay'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Essay  $essay
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Statement $essay) {
		return view('essay.edit', compact('essay'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Essay  $essay
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Statement $essay) {
		request()->validate([
			'title' => 'required',
			'period' => 'required',
			'status' => 'required',
		]);

		$essay->update($request->all());

		return redirect()->route('essays.index')
			->with('success', 'Essay updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Essay  $essay
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Essay $essay) {
		$essay->delete();

		return redirect()->route('essays.index')
			->with('success', 'Essay deleted successfully');
	}
}