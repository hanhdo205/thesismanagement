<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class OpponentController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$data = User::orderBy('id', 'DESC')->paginate(5);
		return view('opponents.index', compact('data'))
			->with('i', ($request->input('page', 1) - 1) * 5);
	}
}
