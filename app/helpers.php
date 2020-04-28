<?php
if (!function_exists('checkIsInReview')) {
	function checkIsInReview($topic_id) {
		$opponents = DB::table('reviews')
			->where('topic_id', $topic_id)
			->where('request_status', REVIEW_WAIT_FOR_ASSIGN)
			->pluck('user_id')
			->toArray();
		if (empty($opponents)) {
			return false;
		}
		return true;
	}
}

if (!function_exists('checkIsWaiting')) {
	function checkIsWaiting($topic_id, $opponents) {
		$waiting = DB::table('reviews')
			->whereIn('user_id', $opponents)
			->where('topic_id', $topic_id)
			->where(function ($query) {
				$query->where('request_status', REVIEW_WAIT_FOR_ASKING)
					->orWhere('request_status', REVIEW_MAIL_FAIL);
			})
			->get();
		return $waiting;
	}
}