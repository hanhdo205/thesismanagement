<?php

//opponents status
define('REVIEW_WAIT_FOR_ASKING', 'fresh');
define('REVIEW_WAIT_FOR_ANSWER', 'mail_send');
define('REVIEW_WAIT_FOR_ASSIGN', 'u_yes');
define('REVIEW_REFUSE', 'u_no');
define('REVIEWING_STATUS_REPORT', 'u_reviewing');
define('REVIEWING_STATUS_FINISH', 'u_finish');

//essays status
define('WAITING_FOR_REVIEW', 'pending');
define('REVIEWING', 'reviewing');
define('REVIEWED', 'reviewed');

//essays reviewing result
define('RESULT_NONE', 'not_yet');
define('RESULT_GOOD', 'good');
define('RESULT_BAD', 'bad');
