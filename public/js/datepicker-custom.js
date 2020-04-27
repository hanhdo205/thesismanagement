(function ($) {
    "use strict";
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

	     $('#ajaxModel').on('hidden.bs.modal', function (e) {
			  to.datepicker( "option", "minDate", null );
			  from.datepicker( "option", "maxDate", null );
		})
	 
	    function getDate( element ) {
	      let date;
	      try {
	        date = $.datepicker.parseDate( dateFormat, element.value );
	      } catch( error ) {
	        date = null;
	      }
	 
	      return date;
	    }
	  } );
}(jQuery));
