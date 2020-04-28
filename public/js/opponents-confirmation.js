$(function () {
   "use strict";
   let $list,$content,$flag = true,
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
	    	if($flag) {
				$flag = false;
				let mailFormData = new FormData();
				mailFormData.append('topic_id', $('#topic_id').val());
				let $destination = [];
		        $.each($("#destination option:selected"), function(){            
		            $destination.push($(this).val());
		        });
				mailFormData.append('opponents', $destination);
				$.ajax({
				  url: opponents.check,
				  type: 'POST',
				  processData: false, // important
				  contentType: false, // important
				  dataType : 'json',
				  data: mailFormData,
				  success: function (data) {
			        if(data.success==true) {
			        	$('#submitBtn').popover('dispose');
			        	$form.submit();
						$('.spinner-border').show();
			        } else {
			        	$('#submitBtn').popover('enable');
			        	$('#submitBtn').popover('show');
			        }
			      }
				});
				$flag = true;
			}
			
	    }
    });
});
