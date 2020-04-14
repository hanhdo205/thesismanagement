$(function () {
   "use strict";
   let $list,$content,
   $form = $('#sendMail');
   $('#submitBtn').on('click', function(){
   		toastr.remove();
		$list = $('#destination').val();
		$content = $('#mailcontent').val();
	   	if ($list == '') {
	        toastr.error(translate.no_destination);
	        return false;
	    }
	    if ($content == '') {
	    	toastr.error(translate.no_content);
	        return false;
	    }
	    else {
			$form.submit();
			$('.spinner-border').show();
	    }
    });
});
