(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
    	let flag = true,$form;
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

		// delete button click -> get form id
		$('form').on('click', '.btnDel', function(e){
		    e.preventDefault();
		    $form=$(this).closest('form');
		});

		// delete confirmation
		$('#confirm').on('click', '#delete-btn', function(e){
		    e.preventDefault();
	        $form.submit();
		});
    });
}(jQuery));
