<div class="right-aside">
    <ul class="tabs" data-tabs id="message-event-tabs">
        <!-- <li class="tabs-title <?php if($this->fetch('title') == 'Events'){ }else{echo 'is-active';} ?>"><a href="#messages">Messages</a></li> -->
        <li class="tabs-title is-active"><a href="#calendar" aria-selected="true">Calendar</a></li>
    </ul>

    <div class="tabs-content" data-tabs-content="message-event-tabs">
        <div class="tabs-panel <?php if($this->fetch('title') == 'Events'){ echo 'is-active'; } ?>" id="calendar">
		    <!-- <a href="javascript:void(0);" id="current-date"><span></span><span id="date">18th April, 2017</span></a> -->

		    <div class="calendar"><div id="datepicker"></div></div>
        </div>
    </div>
</div>

<div class="dropdown-pane" data-position="bottom" data-alignment="left" id="chat-contacts" data-dropdown data-close-on-click="true" data-auto-focus="true">
	<div id="live-contact">

	</div>
</div>

<script>
	$(function() {
		// function autoRefresh_div() {
// 		    $("#live-contact").load("<?= $this->Url->build(DS.'users'.DS.'chat_contacts', true) ?>", function() {
// 		        setTimeout(autoRefresh_div, 60000);
// 				//$('#general-table').DataTable({"pageLength": 50});
// 		    });
// 		}
//
// 		autoRefresh_div();
		
		var availableDates = ['26-10-2017','27-10-2017','28-10-2017'];

		function availableFunction(date) {
		    availday = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
		    if (jQuery.inArray(availday, availableDates) > -1) {
		        return [true,"eventday",""];
		    } else {
		        return [true,"other",""];
		    }
		}
		
		jQuery("#datepicker").datepicker({
		    beforeShowDay: availableFunction
		});
	});
</script>