<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OpponentMail extends Mailable {
	use Queueable, SerializesModels;

	/**
	 * The request instance.
	 *
	 * @var Order
	 */
	protected $user;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(User $user) {
		$this->user = $user;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->view('emails.opponents')
			->with([
				'Name' => $this->user->name,
				'Link' => $this->user->link,
			]);
	}
}
