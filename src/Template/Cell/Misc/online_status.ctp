<?php
use Cake\Chronos\Chronos;
use Cake\I18n\Time;

	if(!empty($userlog)){
		$login_time = new Time($userlog->created);
		$logout_time = new Time($userlog->modified);
		$session_expire = strtotime($userlog->created) + strtotime(SESSION_EXPIRES);
		
		if($userlog->status == 2){
			echo '<span class="online"></span><span class="timeago">'.$login_time->timeAgoInWords().'</span>';
		}elseif($userlog->status == 1 || $session_expire > strtotime("now")){
			echo '<span class="offline"></span><span class="timeago">'.$logout_time->timeAgoInWords().'</span>';
		}else{
			echo '<span class="offline"></span><span class="timeago">'.$logout_time->timeAgoInWords().'</span>';
		}
	}else{
		echo '<span class="offline"></span>';
	}
?>