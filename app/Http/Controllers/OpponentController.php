<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Review;
use App\Topic;
use App\User;
use DB;
use Illuminate\Http\Request;
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
		$topics = Topic::pluck('title', 'id');
		//$topics->prepend(_i('Please select topic'));
		$data = User::orderBy('id', 'DESC')->paginate(5);
		return view('opponents.index', compact(['data', 'topics']))
			->with('i', ($request->input('page', 1) - 1) * 5);
	}
	/**
	 * Display a listing of the resource.
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
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Topic  $topic
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
		}
		Review::create([
			'topic_id' => $topic_id,
			'user_id' => $value,
			'review_status' => $reviewer_status,
			'review_token' => $token,
		]);

		return view('opponents.send');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Essay  $essay
	 * @return \Illuminate\Http\Response
	 */
	public function requestConfirmation(Request $request) {
		$review_token = $request->review_token;
		$rows = DB::table('reviews')
			->join('topics', 'topics.id', '=', 'reviews.topic_id')
			->where('reviews.review_token', $review_token)
			->select('topics.title', 'topics.start_date', 'topics.end_date')
			->first();
		return view('opponents.reply', compact('rows'));
		/*return back()
			->with('success', _i('Thank you for your confirmation.'));*/
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Essay  $essay
	 * @return \Illuminate\Http\Response
	 */
	public function requestReply(Request $request) {
		request()->validate([
			'review_status' => 'required',
		]);

		$review_token = $request->review_token;
		$request = Review::where('review_token', $review_token)->first();

		return back()
			->with('success', _i('Thank you for your confirmation.'));
	}
}
