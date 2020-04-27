<?php
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