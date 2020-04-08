<?php

namespace App\Http\Controllers;

use App\Essay;
use App\Exports\EssaysExport;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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
		return view('essays.index', compact(['topics', 'last_topic_id']));
		/*$essays = self::essayList($last_topic_id);
			return view('essays.index', compact(['essays', 'topics', 'last_topic_id']))
		*/
	}

	public function essayCSVList($topic_id) {
		$rows = DB::table('essays')
			->join('topics', 'essays.topic_id', '=', 'topics.id')
			->where('essays.topic_id', $topic_id)
			->paginate(5);
		return $rows;
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function export(Request $request) {
		$essays = $request->input('essays');
		Excel::store(new EssaysExport($essays), 'essays.csv');

		$myFile = file_get_contents(storage_path('app/essays.csv'));
		$response = array(
			'name' => 'essays.csv',
			'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($myFile), //mime type of used format
		);
		return response()->json($response);
	}

	/**
	 * Ajax for listing
	 * @return json
	 */
	public function essayAjaxList(Request $request) {
		$columns = [
			0 => 'id',
			1 => 'no',
			2 => 'title',
			3 => 'student_name',
			4 => 'review_status',
			5 => 'review_result',
			6 => 'created_at',
		];
		$order_by = 'id';
		$order_sort = 'desc';
		$offset = 0;
		$limit = '';
		if ($request->input('order')) {
			$order_by = $columns[$request->input('order')[0]['column']];
			$order_sort = $request->input('order')[0]['dir'];
		}
		if ($request->input('length') != -1) {
			$offset = $request->input('start');
			$limit = $request->input('length');
		}
		DB::statement(DB::raw("SET @row = '0'"));
		$rows = DB::table('essays')
			->join('topics', 'essays.topic_id', '=', 'topics.id')
			->where('essays.topic_id', $request->input('topic_id'))
			->select(DB::raw("@row:=@row+1 AS no"), 'essays.id', 'essays.essay_title', 'essays.student_name', 'essays.review_status', 'essays.review_result', 'essays.created_at')
			->offset($offset)
			->limit($limit)
			->orderBy($order_by, $order_sort)
			->get();
		$data = [];

		$totalData = count($rows);
		$totalFiltered = count($rows);

		foreach ($rows as $key => $value) {
			$sub_data = [];
			$sub_data[] = '<label class="custom-check">
										<input type="checkbox" name="essays[]" id="' . $value->id . '" class="field" value="' . $value->id . '">
										<span class="checkmark"></span>
									</label>';
			$date = date_create($value->created_at);
			$abs_date = date_format($date, "Y年m月d日");
			$sub_data[] = $value->no;
			$sub_data[] = $value->essay_title;
			$sub_data[] = $value->student_name;
			$sub_data[] = $value->review_status;
			$sub_data[] = $value->review_result;
			$sub_data[] = $abs_date;
			$data[] = $sub_data;
		}

		$json_data = array(
			"draw" => intval($request->input('draw')),
			"recordsTotal" => $totalData,
			"recordsFiltered" => $totalFiltered,
			"data" => $data,
		);
		echo json_encode($json_data);
		die();
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