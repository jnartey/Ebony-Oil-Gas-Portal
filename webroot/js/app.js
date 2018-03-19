
$(function() {
	$(".personal-details-edit").on('click', function(event) {
	    event.preventDefault();
		$("#personal-details-view").fadeOut('fast');
    	$("#personal-details-edit").fadeIn('slow');
	});
	
	$(".personal-details-cancel").on('click', function(event) {
	    event.preventDefault();
		$("#personal-details-edit").fadeOut('fast');
    	$("#personal-details-view").fadeIn('slow');
	});
	
	$('#general-table').DataTable({"pageLength": 50});
	$('#general-table-i').DataTable({"pageLength": 50});
	$('#general-table-ii').DataTable({"pageLength": 50});
	
	$( 'textarea.editor' ).ckeditor();
	
	$('a[title]').qtip({
		position:{
			my: 'bottom center',  // tooltips tip at bottom center...
            at: 'top center', // in relation to the button's top center...
		}
	});
	
	//$('#datepicker').datepicker()
	
	var dateFormat = "yy-mm-dd",
	extra = $( ".extra-date" )
		.datetimepicker({
			oneLine: true,
			timeFormat: 'HH:mm:ss',
			showTimezone: false,
			defaultTime:'now',
			dateFormat: "yy-mm-dd",
			formattedTime: "yy-mm-dd",
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1
		})
		.on( "change", function() {
			//from.datetimepicker( "option", "minDate" );
		});
		
		var startDateTextBox = $('#from');
		var endDateTextBox = $('#to');

		$.timepicker.datetimeRange(
			startDateTextBox,
			endDateTextBox,
			{
				controlType: 'select',
				oneLine: true,
				minInterval: (1000*60*60*2), // 1hr
				dateFormat: "yy-mm-dd",
				timeFormat: 'HH:mm:ss',
				defaultTime:'now',
				//minDate: dateToday,
				onSelect: function (selectedDateTime){
						var start = $(this).datetimepicker('getDate');
						var end = $(this).datetimepicker('getDate');
						// $('#to').datetimepicker('option', 'minDate', new Date(start.getTime()) );
// 						$('#from').datetimepicker('option', 'maxDate', new Date(end.getTime()) );
						
					},
				start: {}, // start picker options
				end: {} // end picker options					
			}
		);
});


//<![CDATA[
//prepare the form when the DOM is ready
// $(document).ready(function() {
//     var options = {
//         target:        '#form-message-i',   // target element(s) to be updated with server response
//         //beforeSubmit:  showRequesti,  // pre-submit callback
//         success:       showResponsei  // post-submit callback
//
//         // other available options:
//         //url:       url         // override for form's 'action' attribute
//         //type:      type        // 'get' or 'post', override for form's 'method' attribute
//         //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
//         //clearForm: true        // clear all form fields after successful submit
//         //resetForm: true        // reset the form after successful submit
//
//         // $.ajax options can be used here too, for example:
//         //timeout:   3000
//     };
//
//     //$("#contact-form").validate();
//     // bind form using 'ajaxForm'
//     $('#password-form').ajaxForm(options);
// });
//
// // pre-submit callback
// function showRequesti(formData, jqForm, options) {
//     // formData is an array; here we use $.param to convert it to a string to display it
//     // but the form plugin does this for you automatically when it submits the data
//     var queryString = $.param(formData);
// 	alert(formData);
// }
//
// // post-submit callback
// function showResponsei(responseText, statusText, xhr, $form)  {
//     // for normal html responses, the first argument to the success callback
//     // is the XMLHttpRequest object's responseText property
//
//     // if the ajaxForm method was passed an Options Object with the dataType
//     // property set to 'xml' then the first argument to the success callback
//     // is the XMLHttpRequest object's responseXML property
//
//     // if the ajaxForm method was passed an Options Object with the dataType
//     // property set to 'json' then the first argument to the success callback
//     // is the json data object returned by the server
//
//     //alert('status: ' + statusText + '\n\nresponseText: \n' + responseText +
//       //  '\n\nThe output div should have already been updated with the responseText.');
//       //$('#form-message').css('display', 'block');
// 	  $("#form-message-i").html(responseText['result']);
// 	  //alert(responseText['result']);
// }
//]]>

// $(window).scroll(function(){
//   var sticky = $('.admin-bar'),
//       scroll = $(window).scrollTop();
//
//   if (scroll >= 100) sticky.addClass('fixed');
//   else sticky.removeClass('fixed');
// });

$(document).foundation()
