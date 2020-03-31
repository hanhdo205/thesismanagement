(function ($) {
    "use strict";
    $(document).ready(function () {
		$('#selectAll').click(function(e){
			var table= $(e.target).closest('table');
			$('td input:checkbox',table).prop('checked',this.checked);
		});
		$('#main-menu').perfectScrollbar();
    });
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
