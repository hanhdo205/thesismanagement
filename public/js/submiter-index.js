$(function () {
    "use strict";
		var table = $('.data-table').DataTable({
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
	        
	    });

	    var student_email, student_emails = []
			table.rows().every(function(rowIdx, tableLoop, rowLoop) {
				student_email = this.data().student_email;
			  if (~student_emails.indexOf(student_email)) {
			    this.nodes().to$().attr('excluded', 'true')
			  } else {
			    student_emails.push(student_email) 
			  }
			})

			$.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
			   return table.row(dataIndex).nodes().to$().attr('excluded') != 'true'
			})

			table.draw()
});
