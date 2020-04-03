<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Mail;

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
		$message = $request->input('mailbody');

		$to_name = 'hanhnq';
		$to_email = 'hanhnq@feelsyncsystem.vn';

		$contents = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head></head><body><p>' . nl2br($message) . '</p></body></html>';

		//Store the content on a file with .blad.php extension in the view/email folder
		$myfile = fopen("../resources/views/emails/opponents.blade.php", "w") or die("Unable to open file!");

		fwrite($myfile, $contents);
		fclose($myfile);

		$data = array('name' => 'HanhNQ(sender_name)', 'body' => 'A test mail');
		Mail::send(['html' => 'emails.opponents'], $data, function ($message) use ($to_name, $to_email) {
			$message->to($to_email, $to_name)
				->subject('Test email');
			$message->from('hanhdo205@gmail.com', 'Test email');
		});

		return view('opponents.send');
	}
}
