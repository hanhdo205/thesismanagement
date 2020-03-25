(function ($) {
    "use strict";
    $(document).ready(function () {
		$('#selectAll').click(function(e){
			var table= $(e.target).closest('table');
			$('td input:checkbox',table).prop('checked',this.checked);
		});
    });
}(jQuery));
