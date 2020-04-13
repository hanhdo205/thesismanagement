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
		if($last_topic_id) {
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
								->select('essays.id', 'essays.essay_title', 'essays.essay_file', 'essays.student_name', 'essays.review_status', 'essays.reviewer_id','essays.review_result', 'essays.created_at')
								->get();
							break;
						case ($request->input('student_name') != ''):
							$data = DB::table('essays')
								->join('topics', 'essays.topic_id', '=', 'topics.id')
								->where('essays.topic_id', $topic_id)
								->where('essays.student_name', 'LIKE', '%' . $student_name . '%')
								->select('essays.id', 'essays.essay_title', 'essays.essay_file', 'essays.student_name', 'essays.review_status', 'essays.reviewer_id','essays.review_result', 'essays.created_at')
								->get();
							break;
						case ($request->input('review_result') != ''):
							$data = DB::table('essays')
								->join('topics', 'essays.topic_id', '=', 'topics.id')
								->where('essays.topic_id', $topic_id)
								->where('essays.review_result', '=', $review_result)
								->select('essays.id', 'essays.essay_title', 'essays.essay_file', 'essays.student_name', 'essays.review_status', 'essays.reviewer_id','essays.review_result', 'essays.created_at')
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

				return view('essays.index', compact(['topics', 'last_topic_id']));
		} else return view('essays.empty');
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
		Excel::store(new EssaysExport($essays), 'essays.csv');

		$myFile = file_get_contents(storage_path('app/essays.csv'));
		$response = array(
			'name' => 'essays.csv',
			'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($myFile), //mime type of used format
		);
		return response()->json($response);
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
		]);
		$input = $request->all();
		$essay->update($input);
		
		

		return redirect()->route('essays.index')
			->with('success', _i('Essay updated successfully'));
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
		return view('essays.register', compact('topic'));
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
			'essay_belong' => 'required',
			'essay_major' => 'required',
			'essay_file' => 'required|mimes:doc,docx,pdf,txt|max:2048',
			'student_name' => 'required',
			'student_gender' => 'required',
			'student_dob' => 'required',
			'student_email' => 'required',
		]);

		$path = $request->file('essay_file')->store('public/essays');
		Essay::create([
			'topic_id' => $request->input('topic_id'),
			'essay_title' => $request->input('essay_title'),
			'essay_belong' => $request->input('essay_title'),
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
		return view('review.request', compact(['essay_lst', 'textarea', 'topic_id']));
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

		$contents = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head></head><body><p>' . nl2br($mailbody) . '</p></body></html>';

		//Store the content on a file with .blade.php extension in the view/emails folder
		$myfile = fopen("../resources/views/emails/revierequest.blade.php", "w") or die("Unable to open file!");

		fwrite($myfile, $contents);
		fclose($myfile);

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
		$essays = DB::table('essays')
			->whereIn('essays.id', $essay_arr)
			->get();
		$file_to_download = [];
		foreach ($essays as $essay) {
			$file_to_download[] = url(Storage::url($essay->essay_file));
		}	
		
		$data = array(
			'Name' => $user->name,
			'Link' => $file_to_download
		);
		try {
			Mail::send(['html' => 'emails.reviewrequest'], $data, function ($message) use ($to_name, $to_email) {
				$message->to($to_email, $to_name)
					->subject('査読対応確認');
				$message->from('hanhdo205@gmail.com', 'thesisManagement');
			});
			$reviewer_status = REVIEWING_STATUS_REPORT;
		} catch (Exception $ex) {
			$reviewer_status = REVIEW_MAIL_FAIL;
		}

		DB::table('reviews')
			->updateOrInsert(
				['topic_id' => $topic_id, 'user_id' => $user_id],
				['request_status' => $reviewer_status]
			);
		foreach ($essays as $essay) {
			DB::table('essays')
				->updateOrInsert(
					['id' => $essay->id],
					['review_status' => REVIEWING]
				);
		}
	}
}