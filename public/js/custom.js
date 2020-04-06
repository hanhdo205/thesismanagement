(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
    	let flag = true;
    	let $form;
    	if($('select').hasClass('select2')) {
    		$('.select2').select2();
    	}

    	if($('form').hasClass('opponent_management')) {
    			let $submit = $('#formSubmit');
	    		$submit.prop('disabled', true);
	    		let $topic,$checkbox;

    		$('#topic_select').on('change', function () {
    			 $topic = $(this).val();
				  $checkbox = $('[name="opponents[]"]:checked');
    			if (($topic > 0) && ($checkbox.length > 0)) {
				    $submit.removeAttr('disabled');
				  } else {
				    $submit.prop('disabled', true);
				  }
		    });
			
			$('input[type=checkbox]').on('click', function(){
				 $topic = $('#topic_select').val();
				  $checkbox = $('[name="opponents[]"]:checked');
    			if (($topic > 0) && ($checkbox.length > 0)) {
				    $submit.removeAttr('disabled');
				  } else {
				    $submit.prop('disabled', true);
				  }
			});

			$('#selectAll').on('click', function(){
				if($('#selectAll:checkbox:checked').length > 0) {
				 $topic = $('#topic_select').val();
    			if (($topic > 0)) {
				    $submit.removeAttr('disabled');
				  }
				} else {
				    $submit.prop('disabled', true);
				  }
			});

    	}
		
    	//table check all rows
		$('#selectAll').click(function(e){
			var table= $(e.target).closest('table');
			$('td input:checkbox',table).prop('checked',this.checked);
		});

		//perfectScrollbar plugin for sidebar
		$('#main-menu').perfectScrollbar();

		//style for upload file field
		if($('#csv_upload_file').length) {
			var fileSelectEle = document.getElementById('csv_upload_file');
			fileSelectEle.onchange = function ()
			{
				//upload_image();
				if(fileSelectEle.value.length == 0) {
					$('.csv_file_name_txt').val('');
				} else {
					$('.csv_file_name_txt').val(fileSelectEle.files[0].name);
				}
			}
		}

		// delete button click -> get form id
		$('form').on('click', '.btnDel', function(e){
		    e.preventDefault();
		    $form=$(this).closest('form');
		});

		// delete confirmation
		$('#confirm').on('click', '#delete-btn', function(e){
		    e.preventDefault();
	        $form.submit();
		});

		//ajax for upload csv
		$('#csv_upload_button').click(function(e){
			e.preventDefault();
			if(flag) {
				var csvFormData = new FormData();
				csvFormData.append('file', $('#csv_upload_file').prop('files')[0]);
				csvFormData.append('_token', $('input[name="_token"]').val());
				flag = false;
				$.ajax({
				  url: base_url + '/import',
				  type: 'POST',
				  processData: false, // important
				  contentType: false, // important
				  dataType : 'json',
				  data: csvFormData,
				  success:function(data)
					   {
					   	if(data.success==1) {
					   		$('#importUsers').modal('hide');
							$('.csv_file_name_txt').val('');
							$('#csv_upload_file').val('');
				   			toastr.success(data.message);
					   	} else {
					   		toastr.error(data.message);
						}
					   }
				});
				flag = true;
			}
		});
    });
}(jQuery));
