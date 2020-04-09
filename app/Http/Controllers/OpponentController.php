<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
		return view('opponents.index', compact(['topics', 'last_topic_id']));
		/*$data = $essays = self::opponentList($last_topic_id);
			return view('opponents.index', compact(['data', 'topics', 'last_topic_id']))
		*/
	}

	public function opponentList($topic_id) {
		$rows = DB::table('reviews')
			->join('topics', 'reviews.topic_id', '=', 'topics.id')
			->join('users', 'reviews.user_id', '=', 'users.id')
			->where('reviews.topic_id', $topic_id)
			->select('users.id', 'users.name', 'reviews.review_status')
			->paginate(5);
		return $rows;
	}

	/**
	 * Ajax for listing
	 */
	public function opponentAjaxList(Request $request) {
		$columns = [
			0 => 'id',
			1 => 'no',
			2 => 'name',
			3 => 'status',
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
		$rows = DB::table('reviews')
			->join('topics', 'reviews.topic_id', '=', 'topics.id')
			->join('users', 'reviews.user_id', '=', 'users.id')
			->where('reviews.topic_id', $request->input('topic_id'))
			->select(DB::raw("@row:=@row+1 AS no"), 'users.id', 'users.name', 'reviews.request_status')
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
										<input type="checkbox" name="opponents[]" id="' . $value->id . '" class="field" value="' . $value->id . '">
										<span class="checkmark"></span>
									</label>';
			$sub_data[] = $value->no;
			$sub_data[] = $value->name;
			$sub_data[] = $value->request_status;
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
				$mailbody = str_replace($m[0][$i], sprintf('{{ $%s }}', $varname), $mailbody);
			}
		}

		$contents = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head></head><body><p>' . nl2br($mailbody) . '</p></body></html>';

		//Store the content on a file with .blad.php extension in the view/email folder
		$myfile = fopen("../resources/views/emails/opponents.blade.php", "w") or die("Unable to open file!");

		fwrite($myfile, $contents);
		fclose($myfile);

		foreach ($opponents as $key => $value) {
			$user = User::find($value);
			$to_name = $user->name;
			$to_email = $user->email;
			$token = Str::random(32);
			$data = array(
				'Name' => $user->name,
				'Link' => url('/request/confirm/' . $token),
			);
			try {
				Mail::send(['html' => 'emails.opponents'], $data, function ($message) use ($to_name, $to_email) {
					$message->to($to_email, $to_name)
						->subject('査読対応確認');
					$message->from('hanhdo205@gmail.com', 'thesisManagement');
				});
				$reviewer_status = 'mail_send';
			} catch (Exception $ex) {
				$reviewer_status = 'mail_fail';
			}

			DB::table('reviews')
				->updateOrInsert(
					['topic_id' => $topic_id, 'user_id' => $value],
					['request_status' => $reviewer_status, 'review_token' => $token]
				);
		}

		return view('opponents.send');
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
			->with('success', _i('Thank you for your confirmation.'));
	}
}
