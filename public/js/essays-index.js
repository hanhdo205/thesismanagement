$(function () {
    "use strict";
		let $topic = $('#topic_select').val(),
		$checkbox,$student_name,$review_result,
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

	    $('#searchBtn').on('click', function(){
		 	$student_name = $('#student_name').val();
			$review_result = $('#review_result').val();
			$('.data-table').DataTable().destroy();
			fetch_data(parseInt($topic));
			  
	    });

		//call a function in success of datatable ajax call
		function checkbox_callback() {
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
			//table check all rows
			$('#selectAll').click(function(e){
				$('td input:checkbox').prop('checked',this.checked);
			});
			$('input[type=checkbox]').on('click', function(){
				 $topic = $('#topic_select').val();
				  $checkbox = $('[name="essays[]"]:checked');
				if (($topic > 0) && ($checkbox.length > 0)) {
				    $selectBtn.removeAttr('disabled');
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
							  url: essays.export,
							  type: 'POST',
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
						      	console.log('Export error: '+ajaxContext.responseText);
						        //toastr.error('Export error: '+ajaxContext.responseText);
						      }
							});
							flag = true;
						}
					});
				} else if($(this).val()=='mail') {
					$('#selectBtn').click(function(e) {
						e.preventDefault();
						$('#reviewRequest').submit();
					 });
				}
			});
		}

		//dataTable
		function fetch_data($topic_id) {
			dataTable = $('.data-table').DataTable({
	        processing: true,
	        serverSide: true,
	        searching: false,
	        scrollX: "100%",
	        order: [[ 1, "asc" ]],
	        columnDefs: [ {
		        "targets": [0,1],
		        "orderable": false,
		        "searchable": false,
		     }],
	        language:
				{
					url : base_url + '/js/datatables/Japanese.json'
				},
	        ajax: {
	        	url: essays.index,
	        	data: {
	        		'topic_id': $topic_id,
	        		'student_name': $student_name,
	        		'review_result': $review_result,
	        	}
	        },
	        columns: [
	        	{data: 'checkbox', name: 'checkbox'},
	            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
	            {data: 'essay_title', name: 'essay_title',fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
						if(oData.filename) {
							$(nTd).html('<a href="'+oData.filename+'">'+oData.essay_title+"</a>");
						}
					}},
	            {data: 'student_name', name: 'student_name'},
	            {data: 'status', name: 'status'},
	            {data: 'result', name: 'result'},
	            {data: 'date', name: 'date'},
	        ],
	        initComplete:function( settings, json){
		            checkbox_callback();
		        }
	    });
		}
});
