$(function () {
    "use strict";
    let fileupload = document.getElementById('essay_upload_file');
    $('.essay_file_name_txt').on('click', function(){
            fileupload.click();
        });
	//style for upload file field
	if($('#essay_upload_file').length) {
		let fileSelectEle = document.getElementById('essay_upload_file');
		fileSelectEle.onchange = function ()
		{
			if(fileSelectEle.value.length == 0) {
				$('.essay_file_name_txt').val('');
			} else {
				$('.essay_file_name_txt').val(fileSelectEle.files[0].name);
			}
		}
	}

	//JqueryUI datePicker
	let dateFormat = "yy/mm/dd",
	dob = $( "#dateOfBirth" )
	    .datepicker({
	      locale: 'ja-jp',
	      changeMonth: true,
	      changeYear: true,
	      maxDate: 0,
	      create: function(input, inst) {
		      $('.ui-datepicker-title').addClass('d-flex justify-content-center');
		  }
	  });

	if($('select').hasClass('select2')) {
		let $this = $('#reviewResult');
		$('.select2').select2({
			language: {
              noResults: function (params) {
                return '見つかりません。';
              }
            },
            escapeMarkup: function (markup) { return markup; }
		});
		if($this.hasClass('is-invalid')) {
			$this.closest('div').find('.select2-selection--single').addClass('is-invalid');
	    }
	}

	

    if($('div').hasClass('alert-danger')) {
		$('body').on('click', '.hide_error', function () {
			$('input, span, textarea, select').removeClass('is-invalid');
			$('.text-danger').html('');
		});
	}
});
