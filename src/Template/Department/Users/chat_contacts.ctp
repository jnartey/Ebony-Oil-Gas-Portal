<?php

use Cake\Chronos\Chronos;
use Cake\I18n\Time;

$this->layout = 'ajax';

if(!empty($users)){
	echo '<ul class="contact-list">';
	foreach($users as $user):
		if($user->user->id != $activeUser['id']){
			
			if(!empty($user->users_log)){
				foreach($user->users_log as $data):
					if($user->modified == $data->created){
						$login_time = new Time($data->created);
						$logout_time = new Time($data->modified);
						$session_expire = strtotime($data->created) + strtotime(SESSION_EXPIRES);
			
						echo '<li>';
						echo '<a href="javascript:void(0)" onclick="javascript:chatWith(\''.$user->user->username.'\')">';
						if($data->status == 2){
							if($user->user->photo){
								echo '<span class="avatar" style="background-image: url('.$this->Url->build(DS.$user->user->photo_dir.DS.'small-'.$user->user->photo, true).')">';
								echo '<span class="is-online"></span></span>';
							}else{
								echo '<span class="avatar" style="background-image: url('.$this->Url->build('/img/dummy.png', true).')">';
								echo '<span class="is-online"></span></span>';
							}
							echo '<div><h6>'.$user->user->name.'</h6><time>'.$logout_time->timeAgoInWords().'</time></div>';
						}elseif($data->status == 1 || $session_expire > strtotime("now")){
							if($user->photo){
								echo '<span class="avatar" style="background-image: url('.$this->Url->build(DS.$user->user->photo_dir.DS.'small-'.$user->user->photo, true).')">';
								echo '<span class="is-online offline"></span></span>';
							}else{
								echo '<span class="avatar" style="background-image: url('.$this->Url->build('/img/dummy.png', true).')">';
								echo '<span class="is-online offline"></span></span>';
							}
							echo '<div><h6>'.$user->user->name.'</h6><time>'.$login_time->timeAgoInWords().'</time></div>';
						}else{
							if($user->user->photo){
								echo '<span class="avatar" style="background-image: url('.$this->Url->build(DS.$user->user->photo_dir.DS.'small-'.$user->user->photo, true).')">';
								echo '<span class="is-online offline"></span></span>';
							}else{
								echo '<span class="avatar" style="background-image: url('.$this->Url->build('/img/dummy.png', true).')">';
								echo '<span class="is-online offline"></span></span>';
							}
							echo '<div><h6>'.$user->user->name.'</h6><time>'.$login_time->timeAgoInWords().'</time></div>';
						}
						echo '</a></li>';
					}
				endforeach;
			}
			
			echo '<li>';
			echo '<a href="javascript:void(0)" onclick="javascript:chatWith(\''.$user->user->username.'\')">';
			if($user->user->photo){
				echo '<span class="avatar" style="background-image: url('.$this->Url->build(DS.$user->user->photo_dir.DS.'small-'.$user->user->photo, true).')">';
				echo '<span class="is-online offline"></span></span>';
			}else{
				echo '<span class="avatar" style="background-image: url('.$this->Url->build('/img/dummy.png', true).')">';
				echo '<span class="is-online offline"></span></span>';
			}
			echo '<div><h6>'.$user->user->name.'</h6></div>';
			echo '</a></li>';
		}		
	endforeach;
	echo '</ul>';
}else{
	echo '';
}
?>