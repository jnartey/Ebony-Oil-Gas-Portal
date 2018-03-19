<div class="right-aside">
    <ul class="tabs" data-tabs id="message-event-tabs">
        <!-- <li class="tabs-title <?php if($this->fetch('title') == 'Events'){ }else{echo 'is-active';} ?>"><a href="#messages">Messages</a></li> -->
        <li class="tabs-title is-active"><a href="#event" aria-selected="true">Event</a></li>
    </ul>

    <div class="tabs-content" data-tabs-content="message-event-tabs">
        <div class="tabs-panel <?php if($this->fetch('title') == 'Events'){ echo 'is-active'; } ?>" id="event">
		    <!-- <a href="javascript:void(0);" id="current-date"><span></span><span id="date">18th April, 2017</span></a> -->
			<ul class="event-list-i">
				<?php
					foreach($events as $event):
						echo '<li>'.$this->Html->link(__($event->name.'<span class="date">'.$event->from_date.'</span>'), ['controller'=> 'DepartmentEvents', 'action' => 'view', $event->id], ['escape'=>false]).'</li>';
					endforeach;
				?>
			</ul>
        </div>
    </div>
</div>