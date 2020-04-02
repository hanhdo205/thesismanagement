(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
    	var flag = true;
    	if($('select').hasClass('select2')) {
    		$('.select2').select2();
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

		// delete confirm
		$('#confirm').on('click', '#delete-btn', function(e){
		    e.preventDefault();
		    var $form=$('#formDelete');
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

    //date picker
    $( function() {
	    var dateFormat = "yy/mm/dd",
	      from = $( "#startDate" )
	        .datepicker({
	          locale: 'ja-jp',
	          changeMonth: true,
	          minDate: 0
	        })
	        .on( "change", function() {
	          to.datepicker( "option", "minDate", getDate( this ) );
	        }),
	      to = $( "#endDate" ).datepicker({
	        locale: 'ja-jp',
          	changeMonth: true,
          	minDate: 0
	      })
	      .on( "change", function() {
	        from.datepicker( "option", "maxDate", getDate( this ) );
	      });
	 
	    function getDate( element ) {
	      var date;
	      try {
	        date = $.datepicker.parseDate( dateFormat, element.value );
	      } catch( error ) {
	        date = null;
	      }
	 
	      return date;
	    }
	  } );
}(jQuery));
