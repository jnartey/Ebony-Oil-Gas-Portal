<?php
 use Cake\Chronos\Chronos;
 use Cake\I18n\Time;
	
 	$end_d = null;
	
	$start_d = new Time($start_date);
	
	if($end_date){
		$end_d = new Time($end_date);
	}
	
	$now = Time::now();
	
	if($raw){
		if($end_d){
			if($end_d > $now){
				if($start_d->isToday()){
					echo 'Event Today';
				}elseif($start_d == $now){
					echo 'Ongoing Event';
				}elseif($start_d->isThisWeek()){
					echo 'Event This Week';
				}elseif($start_d->isThisMonth()){
					echo 'Event This Month';
				}else{
					echo 'Upcoming Event';
				}
			}else{
				if($end_d->isYesterday()){
					echo 'Event Was Yesterday';
				}else{
					echo 'Past Event';
				}
			}
		}else{
			if($start_d->isToday()){
				echo 'Event Today';
			}elseif($start_d == $now){
				echo 'Ongoing Event';
			}elseif($start_d->isThisWeek()){
				echo 'Event This Week';
			}elseif($start_d->isThisMonth()){
				echo 'Event This Month';
			}else{
				echo 'Upcoming Event';
			}
		}
	}else{
		if($end_d){
			if($end_d > $now){
				if($start_d->isToday()){
					echo '<span class="label success">Event Today</span>';
				}elseif($start_d == $now){
					echo '<span class="label success">Ongoing Event</span>';
				}elseif($start_d->isThisWeek()){
					echo '<span class="label success">Event This Week</span>';
				}elseif($start_d->isThisMonth()){
					echo '<span class="label warning">Event This Month</span>';
				}else{
					echo '<span class="label warning">Upcoming Event</span>';
				}
			}else{
				if($end_d->isYesterday()){
					echo '<span class="label alert">Event Was Yesterday</span>';
				}else{
					echo '<span class="label alert">Past Event</span>';
				}
			}
		}else{
			if($start_d->isToday()){
				echo '<span class="label success">Event Today</span>';
			}elseif($start_d == $now){
				echo '<span class="label success">Ongoing Event</span>';
			}elseif($start_d->isThisWeek()){
				echo '<span class="label success">Event This Week</span>';
			}elseif($start_d->isThisMonth()){
				echo '<span class="label warning">Event This Month</span>';
			}else{
				echo '<span class="label warning">Upcoming Event</span>';
			}
		}
	}
	
	
?>