<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MyController extends Controller {
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
	public function import() {
		Excel::import(new UsersImport, request()->file('file'));

		return back();
	}
}