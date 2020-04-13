$(function () {
    "use strict";
    let flag = true,
    dataTable = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        scrollX: "100%",
        order: [[ 0, "asc" ]],
        columnDefs: [ {
		        targets: [0,4],
		        orderable: false,
		        searchable: false,
		     }],
        language:
			{
				url : base_url + '/js/datatables/Japanese.json'
			},
        ajax: topics.index,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'period', name: 'period'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
        ]
    });
     
    $('#createNewTopic').click(function () {
        $('#saveBtn').val(translate.save_btn);
        $('#topic_id').val('');
        $('#topicForm').trigger("reset");
        $('#modelHeading').html(translate.new_topic);
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editTopic', function () {
      var topic_id = $(this).data('id');
      $.get(topics.index +'/' + topic_id +'/edit', function (data) {
          $('#modelHeading').html(translate.edit_topic);
          $('#saveBtn').val(translate.save_btn);
          $('#ajaxModel').modal('show');
          $('#topic_id').val(data.id);
          $('#title').val(data.title);
          $('#startDate').val(data.start_date);
          $('#endDate').val(data.end_date);
      })
   });
    $('body').on('click', '.showTopic', function () {
      var detail_url = $(this).data('url');
      var topic_id = $(this).data('id');
      $.get(topics.index +'/' + topic_id +'/edit', function (data) {
          $('#detailHeading').html(data.title);
          $('#showDetail').modal('show');
          $('#detailTitle').html(data.title);
          $('#detailStartDate').html(data.start_date);
          $('#detailEndDate').html(data.end_date);
          $('#detailUrl').attr('href',detail_url);
          $('#detailUrl').html(detail_url);
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html(translate.sending);
        toastr.remove();
        if(flag) {
          flag = false;
          $.ajax({
            data: $('#topicForm').serialize(),
            url: topics.store,
            type: "POST",
            dataType: 'json',
            success: function (data) {
            		if(data.error) {
            			data.error.forEach(function(e) {
  							  toastr.error(e);
  							});
            		} else {
  	              $('#topicForm').trigger("reset");
  	              $('#ajaxModel').modal('hide');
  	              dataTable.draw();
  	              toastr.success(data.success);
  	         	}
            },
            error: function (data) {
            		//toastr.error(data);
                console.log('Error:', data);
                $('#saveBtn').html(translate.save_changes);
            }
          });
          flag = true;
        }
    });
    
    $('body').on('click', '.deleteTopic', function () {
     
        var topic_id = $(this).data("id");
        //confirm(translate.are_you_sure);
      	$('#confirm').modal('show');
      	// delete button click -> get form id
		$('#confirm').on('click', '#delete-btn', function(e){
		    e.preventDefault();
		    $.ajax({
	            type: "DELETE",
	            url: topics.store+'/'+topic_id,
	            success: function (data) {
	            	$('#confirm').modal('hide');
	            	dataTable.draw();
	            	toastr.success(data.success);
	            },
	            error: function (data) {
	            	//toastr.error(data);
	                console.log('Error:', data);
	            }
	        });
		});
        
    });
     
  });