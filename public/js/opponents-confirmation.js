$(function () {
   "use strict";
   let $list,$content,
   $form = $('#sendMail');
   $('#submitBtn').on('click', function(){
   		toastr.remove();
		$list = $('#destination').val();
		//$content = $('#mailcontent').val();
	   	if ($list == '') {
	        //toastr.error(translate.no_destination);
	        $('#destination').addClass('is-invalid');
	        return false;
	    }
	    if(document.getElementById("mailcontent").value == '') {
	    	//toastr.error(translate.no_content);
	    	$('#mailcontent').addClass('is-invalid');
	        return false;
	    }
	    else {
			$form.submit();
			$('.spinner-border').show();
	    }
    });
});
