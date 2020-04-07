<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class ImExController extends Controller {
	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function importExportView() {
		return view('import');
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function export() {
		return Excel::download(new UsersExport, 'users.xlsx');
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function import(Request $request) {
		$validation = Validator::make($request->all(), [
			'file' => 'required|mimes:csv,txt|max:2048',
		]);
		$topic_id = $request->input('topic_id');
		if ($validation->passes()) {
			Excel::import(new UsersImport($topic_id), request()->file('file'));
			return response()->json([
				'success' => 1,
				'message' => 'CSV Upload Successfully',
				'class_name' => 'alert-success',
			]);
		} else {
			return response()->json([
				'success' => 0,
				'message' => $validation->errors()->all(),
				'class_name' => 'alert-danger',
			]);
		}
	}
}