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
		});
	}
	
	//perfectScrollbar plugin for sidebar
	$('#main-menu').perfectScrollbar();
});