<script type="text/javascript" charset="utf-8" src="/webroot/cometchat/js.php?ext=js"></script>
<link type="text/css" charset="utf-8" rel="stylesheet" media="all" href="/webroot/cometchat/css.php?ext=css" />
<div class="large-12 columns admin-bar">
	<div class="medium-8 columns search"></div>
	<div class="medium-4 columns info-bar">
		<?php
			echo '<div class="user-info">'; 
			echo '<ul class="dropdown menu text-right " data-dropdown-menu>';
			echo '<li class="">';
			
			if($user_pro->photo){
				echo $this->Html->link(__('<span class="user-photo" style="background-image: url('.$this->Url->build(DS.'files'.DS.'Users'.DS.'photo'.DS.'small-'.$user_pro->photo, true).')"></span><span>'.$activeUser['first_name'].' '.$activeUser['last_name'].'</span>'), ['action' => '#'], ['escape'=>false]);
			}else{
				echo $this->Html->link(__('<span class="user-photo" style="background-image: url('.$this->Url->build('/img/dummy.png', true).')"></span><span>'.$activeUser['first_name'].' '.$activeUser['last_name'].'</span>'), ['action' => '#'], ['escape'=>false]);
			}
			
			echo '<ul class="menu text-left">';
			echo '<li>'.$this->Html->link(__('<span class="fa fa-gear"></span> Profile'), ['controller'=> 'users', 'action' => 'view', $activeUser['id']], ['escape'=>false]).'</li>';
			echo '<li>'.$this->Html->link(__('<span class="fa fa-bell-o"></span> Notifications'), ['controller'=> 'users', 'action' => 'view', $activeUser['id']], ['escape'=>false]).'</li>';
			echo '<li>'.$this->Html->link(__('<span class="fa fa-life-ring"></span> Support Tickets'), ['controller'=> 'pages', 'action' => 'dashboard'], ['escape'=>false]).'</li>';
			echo '<li class="border-top">'.$this->Html->link(__('<span class="fa fa-sign-out"></span> Log Out'), ['controller'=> 'users', 'action' => 'logout'], ['escape'=>false]).'</li>';
			echo '</ul>';
			echo '</li>';
			echo '</ul>';
			echo '</div>'; 
		?>
	</div>
</div>
<div class="medium-12 columns panel-wrap">
	<div class="large-12 columns panel-wrap">
		<?= $this->Flash->render() ?>
	</div>
</div>