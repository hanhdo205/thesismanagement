$(function () {
    "use strict";
    window.onload = function () {
    	sessionStorage.removeItem('essays');
	}

		let $topic = $('#topic_select').val(),
		$checkbox,
		$student_name = $('#student_name').val(),
		$review_result = $('#review_result').val(),
		$val,
		$flag = true,
		$url = $('#topic_url').attr('href'),
    	$parts = $url.split("/"),
    	$last_part = $parts[$parts.length-2],
    	$route = $url.substr(0,$url.lastIndexOf('/')),
    	$selectBtn = $('#selectBtn'),
    	$essays = sessionStorage.getItem('essays'),
    	$searchText = sessionStorage.getItem('searchText');
    	$selectBtn.prop('disabled', true);

		fetch_data(parseInt($topic));
		checkBox();

		$('#topic_select').on('change', function () {
			$selectBtn.popover('dispose');
			$('.select2-selection--single').removeClass('is-invalid');
			$('#requestSelect').removeClass('is-invalid');
			 $topic = $(this).val();
			  if ($topic > 0) {
			  	$(".selectAll").prop("checked", false);
			  	$('#topic_url').attr('href',$route + '/' + $topic);
			  	$('#topic_url').html($route + '/' + $topic);
			  	$(".selectAll").prop("checked", false);
				$('.data-table').DataTable().destroy();
				fetch_data(parseInt($topic));
			  }
	    });

	    $('#searchBtn').on('click', function(){
			get_search_text();
			$('.data-table').DataTable().destroy();
			fetch_data(parseInt($topic));
			$(".selectAll").prop("checked", false);
			$('td input:checkbox').prop('checked',false);
			$selectBtn.prop('disabled', true);
			$('.select2-selection--single').removeClass('is-invalid');
			$('#requestSelect').removeClass('is-invalid');
        });

        $val = $('#requestSelect').val();
        request_icon();
			
		$('#requestSelect').on('change', function () {
			$selectBtn.popover('dispose');
			$val = $(this).val();
			request_icon();
			$(this).removeClass('is-invalid');
			$(this).closest('div').find('.select2-selection--single').removeClass('is-invalid');
		});


	    $( document ).ajaxComplete(function( event, request, settings ) {
		  	ajax_callback();
		  	$('[data-toggle="tooltip"]').tooltip();
		});

	    if($('div').hasClass('search_text_alert')) {
			$('body').on('click', '.reset_search', function () {
				$('.reset_search').tooltip('hide');
				sessionStorage.removeItem('searchText');
				$student_name = '';
				$review_result = '';
				$('#student_name').val('');
				$('#review_result').val('');
				$("#review_result").select2({
				   placeholder: translate.review_result
				 });
				$('.data-table').DataTable().destroy();
				fetch_data(parseInt($topic));
			});
		}

		// use for history go back, keep checkboxs status
		function checkBox() {
			if($('.selectAll:checkbox:checked').length > 0) {
		    	 $('input[name="essays[]"]').each(function () {
				 	$(this).prop('checked',true);
				});
		    	 $selectBtn.removeAttr('disabled');
		    } else {
		    	$selectBtn.prop('disabled', true);
		    	 $('input[name="essays[]"]').each(function () {
		    	 	if(jQuery.inArray($(this).attr('id'), [$essays]) !== -1) {
			    	 	$(this).prop("checked", true);
			    	 	$selectBtn.removeAttr('disabled');
			    	}
		    	 });
		    }
		}

		//get searchText
		function get_search_text() {
			$student_name = $('#student_name').val();
			$review_result = $('#review_result').val();
			let $review_result_text = $('#review_result').children("option:selected").text();
			let $topic_text = $('#topic_select').children("option:selected").text();
			let search = [
				{name:'<strong>' + $topic_text + '</strong>'},
				{name:'<strong>' + $student_name + '</strong>'},
				{name:'<strong>' + $review_result_text + '</strong>'},
			]
			$('.search_text').show();
			switch(true) {
			  case ($student_name && $review_result != ''):
			    sessionStorage.setItem('searchText',sprintf(search_text_both,{search:search}));
			    $searchText = sessionStorage.getItem('searchText');
			    $('.search_text').html($searchText);
			    break;
			  case ($student_name && $review_result == ''):
			    sessionStorage.setItem('searchText',sprintf(search_text_name,{search:search}));
			    $searchText = sessionStorage.getItem('searchText');
			    $('.search_text').html($searchText);
			    break;
			  case ($student_name == '' && $review_result != ''):
			    sessionStorage.setItem('searchText',sprintf(search_text_result,{search:search}));
			    $searchText = sessionStorage.getItem('searchText');
			    $('.search_text').html($searchText);
			    break;
			  default:
			  	sessionStorage.removeItem('searchText');
			    $('.search_text').html('');
			    $('.search_text').hide();
			    break;
			}
		}

		//request button icon
		function request_icon() {
			$selectBtn.find('i').removeAttr('class');
			if($val=='csv') {
				$selectBtn.find('i').addClass('fa fa-download');
			} else if($val=='mail') {
				$selectBtn.find('i').addClass('fa fa-envelope-o');
			} else {
				$selectBtn.find('i').addClass('fa fa-ban');
			}
		}

		//call a function in success of datatable ajax call
		function ajax_callback() {
			get_search_text();
			checkBox();

			if($('select').hasClass('custom-select')) {
				$('.custom-select').select2({
					language: {
	                  noResults: function (params) {
	                    return '見つかりません。';
	                  },
	                },
	                minimumResultsForSearch: -1,
                	escapeMarkup: function (markup) { return markup; }
				});
			}

			$('.selectAll').on('click', function(){
				if($('.selectAll:checkbox:checked').length > 0) {
				 $topic = $('#topic_select').val();
				if (($topic > 0)) {
				    $selectBtn.removeAttr('disabled');
				  }
				} else {
				    $selectBtn.prop('disabled', true);
				  }
			});
			//table check all rows
			$('.selectAll').click(function(e){
				$('td input:checkbox').prop('checked',this.checked);
			});
			$('input[type=checkbox]').on('click', function(){
				 $topic = $('#topic_select').val();
				 let $checked = $("td input:checkbox:checked").map(function(){
			      return $(this).val();
			    }).get(); 
				  $checkbox = $('[name="essays[]"]:checked');
				  if($('[name="essays[]"]').length > $checkbox.length) {
				  	$(".selectAll").prop("checked", false);
				  } else {
				  	$(".selectAll").prop("checked", true);
				  }
				if (($topic > 0) && ($checkbox.length > 0)) {
				    $selectBtn.removeAttr('disabled');
				    sessionStorage.setItem('essays', $checked);
				  } else {
				    $selectBtn.prop('disabled', true);
				    sessionStorage.setItem('essays', $checked);
				  }
			});
		}

		//do action when dropdown
		$selectBtn.click(function(e){
			e.preventDefault();
			$selectBtn.popover('dispose');
			if($val=='csv') {
				if($flag) {
					//let $csvFormData = new FormData();
					let $essays = $("table tbody input:checkbox:checked").map(function(){
				      return $(this).val();
				    }).get();
					//$csvFormData.append('essays', $essays);
					//$csvFormData.append('topic', $('#topic_select').val());
					$flag = false;
					/*$.ajax({
					  url: essays.export,
					  type: 'POST',
					  processData: false,
					  contentType: false,
					  dataType : 'json',
					  data: $csvFormData,
					  success: function (response, textStatus, request) {
				        let a = document.createElement('a');
				        a.href = response.file; 
				        a.download = response.name;
				        document.body.appendChild(a);
				        a.click();
				        a.remove();
				      },
				      error: function (ajaxContext) {
				      	console.log('Export error: '+ajaxContext.responseText);
				      }
					});*/
					$.fileDownload(essays.export,{
						httpMethod: 'post',
						data: {
							essays: $essays,
							topic: $('#topic_select').val(),
							_token: $('meta[name="csrf-token"]').attr('content')
						},
						successCallback: function (url) {
							//insert success code

						},
						failCallback: function (html, url) {
							//insert fail code
						}
					});
					$flag = true;
				}
			} else if($val=='mail') {
				let $checked = $("td input:checkbox:checked").map(function(){
				      return $(this).val();
				    }).get();
		    	sessionStorage.setItem('essays', $checked);
		    	if($flag) {
						$flag = false;
						let mailFormData = new FormData();
						mailFormData.append('topic_id', $('#topic_select').val());
						$.ajax({
						  url: essays.check,
						  type: 'POST',
						  processData: false, // important
						  contentType: false, // important
						  dataType : 'json',
						  data: mailFormData,
						  success: function (data) {
					        if(data.success==true) {
					        	$selectBtn.popover('dispose');
					        	$('#reviewRequest').submit();
					        } else {
					        	$selectBtn.popover('enable');
					        	$selectBtn.popover('show');
					        }
					      }
						});
						$flag = true;
					}
			} else {
				$selectBtn.popover('dispose');
				$('#requestSelect').addClass('is-invalid');
				$('#requestSelect').closest('div').find('.select2-selection--single').addClass('is-invalid');
			}
		});

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
						if(oData.detail) {
							$(nTd).html('<a href="'+oData.detail+'">'+oData.essay_title+"</a>");
						}
					}},
	            {data: 'student_name', name: 'student_name'},
	            {data: 'status', name: 'status'},
	            {data: 'result', name: 'result'},
	            {data: 'date', name: 'date'},
	        ]/*,
	        initComplete:function( settings, json){
		            ajax_callback();
		        }*/
	    });
		}
});
