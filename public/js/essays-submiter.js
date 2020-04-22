$(function () {
    "use strict";
		dataTable = $('.data-table').DataTable({
	        processing: true,
	        serverSide: true,
	        searching: false,
	        scrollX: "100%",
	        order: [[ 1, "asc" ]],
	        columnDefs: [ {
		        "targets": [0],
		     }],
	        language:
				{
					url : base_url + '/js/datatables/Japanese.json'
				},
	        ajax: {
	        	url: essays.submiter
	        },
	        columns: [
	            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
	            {data: 'student_name', name: 'student_name'},
	            {data: 'student_email', name: 'student_email'},
	            {data: 'gender', name: 'gender'},
	            {data: 'dob', name: 'dob'},
	        ],
	        initComplete:function( settings, json){
	            if($('select').hasClass('custom-select')) {
	              $('.custom-select').select2({
	              });
	            }
	        }
	    });
});
