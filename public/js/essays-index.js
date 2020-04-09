(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
		let $topic = $('#topic_select').val(),
		$checkbox,
		flag = true,
		$url = $('#topic_url').attr('href'),
    	$parts = $url.split("/"),
    	$last_part = $parts[$parts.length-2],
    	$route = $url.substr(0,$url.lastIndexOf('/')),
    	$selectBtn = $('#selectBtn');
    	$selectBtn.prop('disabled', true);

		fetch_data(parseInt($topic));

		$('#topic_select').on('change', function () {
			 $topic = $(this).val();
			  if ($topic > 0) {
			  	$('#topic_url').attr('href',$route + '/' + $topic);
			  	$('#topic_url').html($route + '/' + $topic);
			  	$("#selectAll").prop("checked", false);
				$('.data-table').DataTable().destroy();
				fetch_data(parseInt($topic));
			  }
	    });

		$('#selectAll').on('click', function(){
			if($('#selectAll:checkbox:checked').length > 0) {
			 $topic = $('#topic_select').val();
			if (($topic > 0)) {
			    $selectBtn.removeAttr('disabled');
			  }
			} else {
			    $selectBtn.prop('disabled', true);
			  }
		});

		$('#requestSelect').on('change', function () {
			if($(this).val()=='csv') {
			    //ajax for download csv
				$selectBtn.click(function(e){
					e.preventDefault();
					if(flag) {
						let $csvFormData = new FormData();
						let $essays = $("table tbody input:checkbox:checked").map(function(){
					      return $(this).val();
					    }).get();
						$csvFormData.append('essays', $essays);
						flag = false;
						$.ajax({
						  url: ajax_url.csv,
						  type: 'POST',
						  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						  processData: false, // important
						  contentType: false, // important
						  dataType : 'json',
						  data: $csvFormData,
						  success: function (response, textStatus, request) {
					        var a = document.createElement("a");
					        a.href = response.file; 
					        a.download = response.name;
					        document.body.appendChild(a);
					        a.click();
					        a.remove();
					      },
					      error: function (ajaxContext) {
					        toastr.error('Export error: '+ajaxContext.responseText);
					      }
						});
						flag = true;
					}
				});
			} else if($(this).val()=='mail') {
				$('#selectBtn').click(function(e) {
					e.preventDefault();
					//$(this).closest('form').submit();
					$('#reviewRequest').submit();
				 });
			}
		});


		//call a function in success of datatable ajax call
		function checkbox_callback() {
			$('input[type=checkbox]').on('click', function(){
				 $topic = $('#topic_select').val();
				  $checkbox = $('[name="essays[]"]:checked');
				if (($topic > 0) && ($checkbox.length > 0)) {
				    $selectBtn.removeAttr('disabled');
				  } else {
				    $selectBtn.prop('disabled', true);
				  }
			});
		}

		//dataTable
		function fetch_data($topic_id) {
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
				   	type: "POST",
				   	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				   	data: {
				        "topic_id": $topic_id
				        }
				   },
			        "initComplete":function( settings, json){
			            checkbox_callback();
			        }

				});
		}
    });
}(jQuery));
