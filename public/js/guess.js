(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
		//style for upload file field
		if($('#essay_upload_file').length) {
			var fileSelectEle = document.getElementById('essay_upload_file');
			fileSelectEle.onchange = function ()
			{
				//upload_image();
				if(fileSelectEle.value.length == 0) {
					$('.essay_file_name_txt').val('');
				} else {
					$('.essay_file_name_txt').val(fileSelectEle.files[0].name);
				}
			}
		}
		//date picker
		$( function() {
		var dateFormat = "yy/mm/dd",
		dob = $( "#dateOfBirth" )
		    .datepicker({
		      locale: 'ja-jp',
		      changeMonth: true,
		      changeYear: true,
		      create: function(input, inst) {
			      $('.ui-datepicker-title').addClass('d-flex justify-content-center');
			  }
		  });
	    
		});
	  });
}(jQuery));
