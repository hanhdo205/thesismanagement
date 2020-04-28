<?php

namespace App\Http\Controllers;

use App\Essay;
use App\Exports\EssaysExport;
use App\Topic;
use Carbon\Carbon;
use DataTables;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class EssayController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	function __construct() {
		$this->middleware('permission:essay-list|submiter-list|review-request', ['only' => ['index', 'submiterList','reviewRequest',]]);
		//$this->middleware('permission:essay-create', ['only' => ['create', 'store']]);
		//$this->middleware('permission:essay-edit', ['only' => ['edit']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		//$topics = Topic::whereDate('end_date', '>', NOW())->orderBy('id', 'desc')->pluck('title', 'id');
		$topics = Topic::orderBy('id', 'desc')->pluck('title', 'id');

		$last_topic_id = array_key_first($topics->toArray());
		$student_name = '';
		$review_result = '';

		if ($request->ajax()) {
			$topic_id = $request->input('topic_id');
			$student_name = $request->input('student_name');
			$review_result = $request->input('review_result');
			switch (true) {
				case (($student_name != '') && ($review_result != '')):
					$data = DB::table('essays')
						->join('topics', 'essays.topic_id', '=', 'topics.id')
						->where('essays.topic_id', $topic_id)
						->where(function ($query) use ($student_name, $review_result) {
							$query->where('essays.student_name', 'LIKE', '%' . $student_name . '%')
								->orWhere('essays.review_result', '=', $review_result);
						})
						->select('topics.title','essays.id', 'essays.essay_title', 'essays.essay_file', 'essays.student_name', 'essays.review_status', 'essays.reviewer_id','essays.review_result', 'essays.created_at')
						->get();
					break;
				case ($request->input('student_name') != ''):
					$data = DB::table('essays')
						->join('topics', 'essays.topic_id', '=', 'topics.id')
						->where('essays.topic_id', $topic_id)
						->where('essays.student_name', 'LIKE', '%' . $student_name . '%')
						->select('topics.title','essays.id', 'essays.essay_title', 'essays.essay_file', 'essays.student_name', 'essays.review_status', 'essays.reviewer_id','essays.review_result', 'essays.created_at')
						->get();
					break;
				case ($request->input('review_result') != ''):
					$data = DB::table('essays')
						->join('topics', 'essays.topic_id', '=', 'topics.id')
						->where('essays.topic_id', $topic_id)
						->where('essays.review_result', '=', $review_result)
						->select('topics.title','essays.id', 'essays.essay_title', 'essays.essay_file', 'essays.student_name', 'essays.review_status', 'essays.reviewer_id','essays.review_result', 'essays.created_at')
						->get();
					break;
				default:
					$data = DB::table('essays')
						->join('topics', 'essays.topic_id', '=', 'topics.id')
						->where('essays.topic_id', $topic_id)
						->select('essays.id', 'essays.essay_title', 'essays.essay_file', 'essays.student_name', 'essays.review_status', 'essays.reviewer_id','essays.review_result', 'essays.created_at')
						->get();
					break;
			}

			return Datatables::of($data)
				->addColumn('checkbox', function ($row) {
					$checkbox = '<label class="custom-check"><input type="checkbox" name="essays[]" id="' . $row->id . '" class="field" value="' . $row->id . '"><span class="checkmark"></span></label>';
					return $checkbox;
				})
				->addColumn('detail', function ($row) {
					if($row->reviewer_id) {
						$detail =  route('essays.edit',$row->id);
					} else $detail ='';
					return $detail;
				})
				->addColumn('status', function ($row) {
					$status = _i($row->review_status);
					return $status;
				})
				->addColumn('result', function ($row) {
					$result = _i($row->review_result);
					return $result;
				})
				->addColumn('date', function ($row) {
					$date = Carbon::createFromFormat('Y-m-d H:i:s',$row->created_at)->format('Y年m月d日');;
					return $date;
				})
				->rawColumns(['date'])
				->rawColumns(['status'])
				->rawColumns(['result'])
				->rawColumns(['detail'])
				->rawColumns(['checkbox'])
				->addIndexColumn()
				->make(true);
		}
		if($last_topic_id) {
				return view('essays.index', compact(['topics', 'last_topic_id', 'student_name','review_result']));
		} else {
			return view('essays.empty', compact('topics'));
		}
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function submiterList(Request $request) {
		
		if ($request->ajax()) {
			$data = Essay::select('student_name','student_email', 'student_gender', 'student_dob')->get();
			$grouped = $data->groupBy('student_email');
			$new_data = [];
			foreach($grouped as $group) {
				$new_data[] = $group[0];
			}
			
			return Datatables::of($new_data)
				->addColumn('gender', function ($row) {
					$gender = _i($row->student_gender);
					return $gender;
				})
				->addColumn('dob', function ($row) {
							$dob = Carbon::createFromFormat('Y/m/d',$row->student_dob)->format('Y年m月d日');;
							return $dob;
						})
				->rawColumns(['gender'])
				->rawColumns(['dob'])
				->addIndexColumn()
				->make(true);
		}

		return view('essays.submiter');
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function export(Request $request) {
		$essays = $request->input('essays');
		$topic_id = $request->input('topic');
		$topic = Topic::where('id', $topic_id)->first();
		
		ob_start();	

		$header_row = [
			'No',
			'タイトル',
			'氏名',
			'ステータス',
			'査読結果',
			'提出日',
		];

								
		$f = fopen('php://temp', "r+");

		$title_row = [sprintf('タイトル: %s',$topic->title)];
		fputcsv($f, $title_row, ',' , '"');
		fputcsv($f, $header_row, ',' , '"');

		if (!$f) {
			echo 'error';
			exit;
		}
		
		DB::statement(DB::raw("SET @row = '0'"));
		$rows = DB::table('essays')
			->whereIn('id', $essays)
			->select(DB::raw("@row:=@row+1 AS no"), 'essay_title', 'student_name', 'review_status', 'review_result', 'created_at')
			->get();
		foreach($rows as $row) {
			$_row = [
				$row->no,
				$row->essay_title,
				$row->student_name,
				_i($row->review_status),
				_i($row->review_result),
				date_format(date_create($row->created_at), "Y年m月d日"),
			];
			fputcsv($f, $_row, ',', '"'); 
		}

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename=essays.csv');
		
		rewind($f);
		while (($buf = fgets($f)) !== false) :
			echo mb_convert_encoding($buf, 'SJIS-win', mb_internal_encoding());
		endwhile;

		fclose($f);

		ob_flush();
		
		// Excel::store(new EssaysExport($essays), 'essays.csv');

		// $myFile = file_get_contents(storage_path('app/essays.csv'));
		// $response = array(
			// 'name' => 'essays.csv',
			// 'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($myFile), //mime type of used format
		// );
		// return response()->json($response);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Topic  $topic
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Essay $essay) {
		$rows = DB::table('essays')
			->join('users', 'users.id', '=', 'essays.reviewer_id')
			->where('essays.id', $essay->id)
			->select('essays.*', 'users.name AS reviewer')
			->first();
			
		return view('essays.edit', compact('rows'));
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Topic  $topic
	 * @return \Illuminate\Http\Response
	 */
	public function review(Request $request) {
		$rows = DB::table('essays')
			->join('users', 'users.id', '=', 'essays.reviewer_id')
			->join('reviews', 'reviews.user_id', '=', 'essays.reviewer_id')
			->where('essays.id', $request->id)
			->where('reviews.review_token', $request->token)
			->select('essays.*', 'users.name AS reviewer')
			->first();
		if (empty($rows)) {
			return abort(404);
		}
		return view('essays.review', compact('rows'));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Topic  $topic
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Essay $essay) {
		request()->validate([
			'essay_title' => 'required',
			'essay_belong' => 'required',
			'essay_major' => 'required',
			'student_name' => 'required',
			'student_name' => 'required',
			'review_comment' => 'required',
			'review_result' => 'required',
		]);
		if($request->input('review_result')) {
			$input = [
				'review_status' => REVIEWED,
				'review_result' => $request->input('review_result'),
				'review_comment' => $request->input('review_comment')
			];
		} else {
			$input = $request->all();
		}
		$essay->update($input);

		return back()
			->with('success', _i('Essay updated successfully'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
		$id = $request->id;
		$topic = Topic::where('id', $id)->first();
		$start_date = Carbon::createFromDate($topic->start_date);
		$end_date = Carbon::createFromDate($topic->end_date);
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
		
		
		
		if (empty($topic)) {
			return abort(404);
		}
		return view('essays.register', compact(['topic','status']));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		request()->validate([
			'essay_title' => 'required',
			'essay_belong' => 'required',
			'essay_major' => 'required',
			'essay_file' => 'required|mimes:doc,docx,pdf,txt|max:10240',
			'student_name' => 'required',
			'student_gender' => 'required',
			'student_dob' => 'required',
			'student_email' => 'required|email',
		]);

		$path = $request->file('essay_file')->store('public/essays');
		Essay::create([
			'topic_id' => $request->input('topic_id'),
			'essay_title' => $request->input('essay_title'),
			'essay_belong' => $request->input('essay_belong'),
			'essay_major' => $request->input('essay_major'),
			'student_name' => $request->input('student_name'),
			'student_gender' => $request->input('student_gender'),
			'student_dob' => $request->input('student_dob'),
			'student_email' => $request->input('student_email'),
			'essay_file' => $path,
		]);

		return back()
			->with('success', _i('Registration successfully.'));
	}

	/**
	 * Show the review request form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function reviewRequest(Request $request) {
		$essays_request = $request->input('essays');
		$topic_id = $request->input('topic');
		$student_name = $request->input('student_name');
		$review_result = $request->input('review_result');
		
		$essays = Essay::whereIn('id', $essays_request)->get();
		if (empty($essays)) {
			return abort(404);
		}
		$textarea = '';
		$essays_arr = [];
		foreach ($essays as $essay) {
			$textarea .= $essay->essay_title . ' - 著: ' . $essay->student_name . '&#13;&#10;';
			$essays_arr[] = $essay->id;
		}
		$essay_lst = implode(',', $essays_arr);
		return view('review.request', compact(['essay_lst', 'textarea', 'topic_id','student_name','review_result']));
	}

	/**
	 * Collect data to send request review to each teacher.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function sendMail(Request $request) {
		//Get Content From The Form
		$mailbody = $request->input('mailbody');
		$topic_id = $request->input('topic_id');
		$essays = explode(',',$request->input('essays'));

		$opponents = DB::table('reviews')
					->where('topic_id', $topic_id)
					->where('request_status', REVIEW_WAIT_FOR_ASSIGN)
					->pluck('user_id')
					->toArray();
		if (empty($opponents)) {
			return view('review.empty');
		}
		switch (true) {
			case (count($opponents) > count($essays)):
				$new_opponents = array_slice($opponents,0,count($essays));
				$combine = array_combine($new_opponents, $essays);
				$key = 'opponent';
				break;
			case (count($opponents) < count($essays)):
				$multiple = ceil(count($essays)/count($opponents));
				$new_opponents = [];
				for($i=0;$i<$multiple;$i++) {
					$new_opponents = array_merge($opponents, $new_opponents);
				}
				$new_opponents = array_slice($new_opponents,0,count($essays));
				$combine = array_combine($essays, $new_opponents);
				$key = 'essay';
				break;
			default:
				$combine = array_combine($opponents, $essays);
				$key = 'opponent';
				break;
		}
						
		if($key == 'opponent') { //opponent is a key
			foreach($combine as $user => $essay) {
				$essay_arr = [$essay];
				self::doSendMail($topic_id, $user, $essay_arr);
			}
		} else { //essay is a key
			$multi_essay_per_opponent = [];
			foreach($combine as $key => $value) {
				$multi_essay_per_opponent[$value][] = $key;
			}
			foreach($multi_essay_per_opponent as $user => $essay_arr) {
				self::doSendMail($topic_id, $user, $essay_arr);
			}
		}
		return Redirect::route('essays.index')
			->with(['success' => _i('The emails were send.'), 'topic_id' => $topic_id]);
	}
	
	public function doSendMail($topic_id, $user_id, $essay_arr) {
		$user = User::find($user_id);
		$to_name = $user->name;
		$to_email = $user->email;
		$from_email = env("MAIL_FROM_ADDRESS", "hanhdo205@gmail.com");
		$from_name = env("MAIL_FROM_NAME", "thesisManagement");
		$token = Str::random(32);
		$essays = DB::table('essays')
			->whereIn('essays.id', $essay_arr)
			->get();
		$topic = Topic::where('id', $topic_id)->first();
		$essay_url = [];
		foreach ($essays as $essay) {
			// $file_to_download[] = url(Storage::url($essay->essay_file));
			$essay_url[] = route('essays.review',['id' => $essay->id,'token' => $token]);
		}	
		
		$data = array(
			'Name' => $user->name,
			'Topic' => $topic->title,
			'Link' => $essay_url
		);
		try {
			Mail::send(['html' => 'emails.reviewrequest'], $data, function ($message) use ($to_name, $to_email, $from_email, $from_name) {
				$message->to($to_email, $to_name)
					->subject('査読依頼');
				$message->from($from_email, $from_name);
			});
			$reviewer_status = REVIEWING_STATUS_REPORT;
		} catch (Exception $ex) {
			$reviewer_status = REVIEW_MAIL_FAIL;
		}

		DB::table('reviews')
			->updateOrInsert(
				['topic_id' => $topic_id, 'user_id' => $user_id],
				['request_status' => $reviewer_status,'review_token' => $token]
			);
		foreach ($essays as $essay) {
			DB::table('essays')
				->updateOrInsert(
					['id' => $essay->id],
					['review_status' => REVIEWING, 'reviewer_id' => $user_id]
				);
		}
	}
	
	public function isReview(Request $request) {
		$topic_id = $request->input('topic_id');
		if (!checkIsInReview($topic_id)) {
			return response()->json(['success' => false]);
		}
		return response()->json(['success' => true]);
	}
}