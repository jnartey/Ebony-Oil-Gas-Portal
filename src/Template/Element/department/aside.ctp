<div class="right-aside">
    <ul class="tabs" data-tabs id="message-event-tabs">
        <!-- <li class="tabs-title <?php if($this->fetch('title') == 'Events'){ }else{echo 'is-active';} ?>"><a href="#messages">Messages</a></li> -->
        <li class="tabs-title is-active"><a href="#calendar" aria-selected="true">Calendar</a></li>
    </ul>

    <div class="tabs-content" data-tabs-content="message-event-tabs">
        <!-- <div class="tabs-panel <?php if($this->fetch('title') == 'Events'){ }else{echo 'is-active';} ?>" id="messages"> -->
            <!-- <div class="current-conversation">
                Current Conversations <a href="javascript:console.log('new-conversation');"><span>+</span></a>
			</div> -->
            <!-- <ul class="conversation-list">
                <li class="active">
                    <span class="avatar" style="background-image: url(<?= $this->Url->build('/img/dummy.png', true); ?>)">
                        <span class="is-online"></span>
                    </span>
                    <div>
                        <h3>Kwame Nti</h3>
                        <p>What is wrong with your homework?</p>
                        <time>Just now</time>
                    </div>
                </li>

                <li>
                    <span class="avatar" style="background-image: url(<?= $this->Url->build('/img/dummy.png', true); ?>)"><span class="is-online offline"></span></span>
                    <div>
                        <h3>John Mensah</h3>
                        <p>Hey dude! What's the plan?</p>
                        <time>2 hours ago</time>
                    </div>
                </li>
                <li>
                    <span class="avatar" style="background-image: url(<?= $this->Url->build('/img/dummy.png', true); ?>)"><span class="is-online"></span></span>
                    <div>
                        <h3>James Quaye</h3>
                        <p>Have you tried my formula?</p>
                        <time>Just now</time>
                    </div>
                </li>
                <li>
                    <span class="avatar" style="background-image: url(<?= $this->Url->build('/img/dummy.png', true); ?>)"><span class="is-online"></span></span>
                    <div>
                        <h3>Kojo Nkansah</h3>
                        <p>I finished it 2 days ago</p>
                        <time>Just now</time>
                    </div>
                </li>
            </ul> -->
        <!-- </div> -->
        <div class="tabs-panel <?php if($this->fetch('title') == 'Events'){ echo 'is-active'; } ?>" id="calendar">
		    <!-- <a href="javascript:void(0);" id="current-date"><span></span><span id="date">18th April, 2017</span></a> -->

		    <div class="calendar"><div id="datepicker"></div></div>
        </div>
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