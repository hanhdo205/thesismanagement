$(function () {
    "use strict";
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
	let flag = true;
	if($('select').hasClass('select2')) {
		$('.select2').select2({
			language: {
              noResults: function (params) {
                return '見つかりません。';
              }
            },
                escapeMarkup: function (markup) { return markup; }
		});
	}
	
	//perfectScrollbar plugin for sidebar
	$('#main-menu').perfectScrollbar();

	if($('div').hasClass('alert-danger')) {
		$('body').on('click', '.hide_error', function () {
			$('input').removeClass('is-invalid');
			$('.text-danger').html('');
		});
	}
});