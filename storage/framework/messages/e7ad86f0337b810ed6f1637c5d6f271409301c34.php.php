<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Topic;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class OpponentController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	function __construct() {
		$this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
		$this->middleware('permission:opponent-confirmation', ['only' => ['confirmation', 'sendMail']]);
		$this->middleware('permission:opponent-sendrequest', ['only' => ['sendRequest']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$topics = Topic::whereDate('end_date', '>', NOW())->orderBy('id', 'desc')->pluck('title', 'id');
		$last_topic_id = array_key_first($topics->toArray());

		if ($request->ajax()) {
			$data = DB::table('reviews')
				->join('topics', 'reviews.topic_id', '=', 'topics.id')
				->join('users', 'reviews.user_id', '=', 'users.id')
				->where('reviews.topic_id', $request->input('topic_id'))
				->select('users.id', 'users.name', 'reviews.request_status')
				->get();
			return Datatables::of($data)
				->addColumn('checkbox', function ($row) {

					$checkbox = '<label class="custom-check"><input type="checkbox" name="opponents[]" id="' . $row->id . '" class="field" value="' . $row->id . '"><span class="checkmark"></span></label>';
					return $checkbox;
				})
				->addColumn('status', function ($row) {
					$status = _i($row->request_status);
					return $status;
				})
				->rawColumns(['status'])
				->rawColumns(['checkbox'])
				->addIndexColumn()
				->make(true);
		}

		return view('opponents.index', compact(['topics', 'last_topic_id']));
	}

	/**
	 * Show the form for prepare send mail.
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
	 * Send mail.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function sendMail(Request $request) {
		//Get Content From The Form
		$opponents = $request->input('opponents');
		$mailbody = $request->input('mailbody');
		$topic_id = $request->input('topic_id');

		if (preg_match_all("/{(.*?)}/", $mailbody, $m)) {
			foreach ($m[1] as $i => $varname) {
				if ($varname == 'Link') {
					$mailbody = str_replace($m[0][$i], sprintf('<a href="{{ $%s }}">{{ $%s }}</a>', $varname, $varname), $mailbody);
				} else {
					$mailbody = str_replace($m[0][$i], sprintf('{{ $%s }}', $varname), $mailbody);
				}
			}
		}

		$contents = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head></head><body><p>' . nl2br($mailbody) . '</p></body></html>';

		//Store the content on a file with .blad.php extension in the view/email folder
		$myfile = fopen("../resources/views/emails/opponents.blade.php", "w") or die("Unable to open file!");

		fwrite($myfile, $contents);
		fclose($myfile);

		foreach ($opponents as $key => $value) {
			self::doSendMail($value, $topic_id);
		}
		return Redirect::route('opponents.index')
			->with(['success' => _i('The emails were send.'), 'topic_id' => $topic_id]);
	}

	public function doSendMail($user_id, $topic_id) {
		$user = User::find($user_id);
		$to_name = $user->name;
		$to_email = $user->email;
		$from_email = env("MAIL_FROM_ADDRESS", "hanhdo205@gmail.com");
		$from_name = env("MAIL_FROM_NAME", "thesisManagement");
		$token = Str::random(32);
		$data = array(
			'Name' => $user->name,
			'Link' => url('/request/confirm/' . $token),
		);
		try {
			Mail::send(['html' => 'emails.opponents'], $data, function ($message) use ($to_name, $to_email, $from_email, $from_name) {
				$message->to($to_email, $to_name)
					->subject('査読対応確認');
				$message->from($from_email, $from_name);
			});
			$reviewer_status = REVIEW_WAIT_FOR_ANSWER;
		} catch (Exception $ex) {
			$reviewer_status = REVIEW_MAIL_FAIL;
		}

		DB::table('reviews')
			->updateOrInsert(
				['topic_id' => $topic_id, 'user_id' => $user_id],
				['request_status' => $reviewer_status, 'review_token' => $token]
			);
	}

	/**
	 * Show the form for confirm the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function requestConfirmation(Request $request) {
		$review_token = $request->review_token;
		$rows = DB::table('reviews')
			->join('topics', 'topics.id', '=', 'reviews.topic_id')
			->where('reviews.review_token', $review_token)
			->select('topics.title', 'topics.start_date', 'topics.end_date')
			->first();
		if (empty($rows)) {
			return abort(404);
		}
		return view('opponents.reply', compact(['rows', 'review_token']));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Essay  $essay
	 * @return \Illuminate\Http\Response
	 */
	public function requestReply(Request $request) {
		request()->validate([
			'request_status' => 'required',
		]);

		$affected = DB::table('reviews')
			->where('review_token', $request->input('review_token'))
			->update(['request_status' => $request->input('request_status')]);

		return back()
			->with('success', [_i('Thank you for your confirmation.'), $request->input('request_status')]);
	}
}
