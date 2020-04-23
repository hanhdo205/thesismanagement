<?php

namespace App\Http\Controllers;

use App\Topic;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
	public function index(Request $request) {
		if ($request->ajax()) {
			$data = Topic::latest()->get();
			return Datatables::of($data)
				->addIndexColumn()
				->addColumn('period', function ($row) {
					$from = Carbon::createFromDate($row->start_date)->format('Y年m月d日');
					$to = Carbon::createFromDate($row->end_date)->format('Y年m月d日');
					$duration = $from . ' ～ ' . $to;
					return $duration;
				})
				->addColumn('status', function ($row) {
					$start_date = Carbon::createFromDate($row->start_date);
					$end_date = Carbon::createFromDate($row->end_date);
					$now = Carbon::today();
					switch (true) {
					case ($end_date < $now):
						$status = _i(EXPIRED);
						break;
					case ($start_date > $now):
						$status = _i(COMMING_SOON);
						break;
					default:
						$status = _i(AVAILABLE);
						break;
					}
					return $status;
				})
				->addColumn('action', function ($row) {

					$btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-id="' . $row->id . '" data-url="' . route('topic.endai_teisyutu', ['id' => $row->id]) . '" data-original-title="' . _i('Show') . '" title ="' . _i('Show') . '" class="edit btn btn-info btn-sm showTopic"><i class="fa fa-eye" aria-hidden="true"></i></a>';

					$btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-id="' . $row->id . '" data-original-title="' . _i('Edit') . '" title ="' . _i('Edit') . '" class="edit btn btn-primary btn-sm editTopic"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

					$btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-id="' . $row->id . '" data-original-title="' . _i('Delete') . '" title ="' . _i('Delete') . '" class="btn btn-danger btn-sm deleteTopic"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';

					return $btn;
				})
				->rawColumns(['period'])
				->rawColumns(['status'])
				->rawColumns(['action'])
				->make(true);
		}

		return view('topics.index');
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
		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()->all()]);
		}
		Topic::updateOrCreate(['id' => $request->topic_id],
			['title' => $request->title, 'start_date' => $request->start_date, 'end_date' => $request->end_date]);
		return response()->json(['success' => _i('Topic saved successfully.')]);
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Topic  $topic
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Topic $topic) {
		/*return view('topics.edit', compact('topic'));*/
		return response()->json($topic);
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

		/*return redirect()->route('topics.index')
			->with('success', 'Topic updated successfully');*/
		return response()->json(['success' => _i('Topic saved successfully.')]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Topic  $topic
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Topic $topic) {
		$topic->delete();
		/*return redirect()->route('topics.index')
			->with('success', 'Topic deleted successfully');*/
		return response()->json(['success' => _i('Topic deleted successfully.')]);
	}
}