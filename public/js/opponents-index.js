(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
    	let flag = true,
		$submit = $('#formSubmit'),
		$action_btn = $('#action-button a'),
		$topic = $('#topic_select').val(),
		$checkbox;
		$submit.prop('disabled', true);

		if($topic > 0) {
			$action_btn.removeClass('disabled');
		} else {
			$action_btn.click(false);
	    	$action_btn.addClass('disabled');
		}

		fetch_data(parseInt($topic));

		$('#topic_select').on('change', function () {
			 $topic = $(this).val();
			  $checkbox = $('[name="opponents[]"]:checked');
			  if ($topic > 0) {
				$action_btn.removeClass('disabled');
				$("#selectAll").prop("checked", false);
				$('.data-table').DataTable().destroy();
				fetch_data(parseInt($topic));
			  } else {
			    //$action_btn.click(false);
			    $action_btn.addClass('disabled');
			  }
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

		//call a function in success of datatable ajax call
		function checkbox_callback() {
			$('input[type=checkbox]').on('click', function(){
				 $topic = $('#topic_select').val();
				  $checkbox = $('[name="opponents[]"]:checked');
				if (($topic > 0) && ($checkbox.length > 0)) {
				    $submit.removeAttr('disabled');
				  } else {
				    $submit.prop('disabled', true);
				  }	
			});
		}

		//dataTable
		function fetch_data(topic_id) {
			dataTable = $('.data-table').DataTable({
				   processing: true,
				   serverSide: true,
				   searching: false,
				   order: [[ 1, "asc" ]],
				   aoColumnDefs: [
				        { "bSortable": false, "aTargets": [ 0 ] },
				        { "bSearchable": false, "aTargets": [ 0 ] }
				    ],
				   language:
					{
						 "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
					},
				   ajax: {
				   	url: ajax_url.table,
				   	type: "post",
				   	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				   	data: {
				        "topic_id": topic_id
				        }
				   },
			        "initComplete":function( settings, json){
			            checkbox_callback();
			        }

				});
		}

		//ajax for upload csv
		$('#csv_upload_button').click(function(e){
			e.preventDefault();
			if(flag) {
				var csvFormData = new FormData();
				csvFormData.append('topic_id', $('#topic_select').val());
				csvFormData.append('file', $('#csv_upload_file').prop('files')[0]);
				flag = false;
				$.ajax({
				  url: ajax_url.import_csv,
				  type: 'POST',
				  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
				   			dataTable.draw();
					   	} else {
					   		toastr.error(data.message);
						}
					   }
				});
				flag = true;
			}
		});

		//ajax for create new opponent
		$('#new_opponent_button').click(function(e){
			e.preventDefault();
			if(flag) {
				var csvFormData = new FormData();
				csvFormData.append('topic_id', $('#topic_select').val());
				csvFormData.append('email', $('#inputEmail').val());
				csvFormData.append('name', $('#inputName').val());
				flag = false;
				$.ajax({
				  url: ajax_url.create_new,
				  type: 'POST',
				  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				  processData: false, // important
				  contentType: false, // important
				  dataType : 'json',
				  data: csvFormData,
				  success:function(data)
					   {
					   	if(data.id) {
					   		$('#newUser').modal('hide');
					   		toastr.success(translate.opponent_created);
				   			dataTable.draw();
					   	} else {
					   		data.forEach(function(e) {
							  toastr.error(e.error);
							});
					   		
					   	}
					   }
				});
				flag = true;
			}
		});
    });
}(jQuery));
