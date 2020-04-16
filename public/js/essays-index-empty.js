$(function () {
    "use strict";
		

		//dataTable
		
			dataTable = $('.data-table').DataTable({
	        processing: true,
	        serverSide: true,
	        searching: false,
	        scrollX: "100%",
	        language:
				{
					url : base_url + '/js/datatables/Japanese.json'
				},
	        ajax: {
	        	url: essays.index,
	        	data: {}
	        },
	        columns: [
	        	{data: 'checkbox', name: 'checkbox'},
	            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
	            {data: 'essay_title', name: 'essay_title'},
	            {data: 'student_name', name: 'student_name'},
	            {data: 'status', name: 'status'},
	            {data: 'result', name: 'result'},
	            {data: 'date', name: 'date'},
	        ]
	    });
		
});
