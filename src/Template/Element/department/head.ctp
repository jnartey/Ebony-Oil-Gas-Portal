<?
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use Cake\Chronos\Chronos;
use Cake\I18n\Time;

$this->layout = 'default';
?>

<!-- src/Template/Cell/Misc/head.ctp -->
<!--Router::url(['controller' => 'Pages', 'action' => 'index']) -->
<div class="columns large-12 sticky-container" data-sticky-container>
	  <div class="title-bar" data-sticky data-top-anchor="mains:top" data-margin-top="0" style="width:100%">
		<header class="large-12 columns navbar">
		    <div class="large-12 columns main-navbar">
		        <div class="row">
					<?php
						//Logo
						echo $this->Html->link(__($this->Html->image("ebony-logo.jpg", ["alt" => "Ebony Oil & Gas"])), ['controller'=> 'pages', 'action' => 'index'], ['escape'=>false, 'class'=>'large-4 columns logo']);
						
						if(!$activeUser){
							echo '<div class="large-8 columns">';
							echo '<ul class="medium-12 columns menu sp text-right">';
							echo '<li>'.$this->Html->link(__('<span>Home</span>'), ['controller'=> 'pages', 'action' => 'index'], ['escape'=>false]).'</li>';
							echo '<li>'.$this->Html->link(__('<span>Company Profile</span>'), ['controller'=> 'pages', 'action' => 'company-profile'], ['escape'=>false]).'</li>';
							echo '<li>'.$this->Html->link(__('<span>Sign In</span>'), ['controller'=> 'users', 'action' => 'login'], ['escape'=>false]).'</li>';
							echo '</ul>';
							echo '</div>';
						}
				
						if($activeUser){
							if(isset($activeUser['role_id']) || $activeUser['role_id'] == 1) {
								echo '<div class="large-8 columns">';
								
								echo '<ul class="medium-5 columns notifications text-right">';
								// echo '<li><a href="javascript:console.log(\'notification\');" id="new-messages" class="fa fa-bell-o"><span>1</span></a></li>';
// 								echo '<li><a href="javascript:console.log(\'notification\');" id="new-messages" class="fa fa-envelope-o"><span>100</span></a></li>';
// 								echo '<li><a href="javascript:console.log(\'notification\');" id="sent-messages" class="fa fa-paper-plane"><span>0</span></a></li>';
								echo '</ul>';
								
								echo '<ul class="medium-7 columns dropdown menu text-right" data-dropdown-menu>';
								echo '<li>';
								echo $this->Html->link(__('<span class="fa fa-plus icon"></span>'), ['action' => '#'], ['escape'=>false]);
								echo '<ul class="menu text-left">';
								echo '<li>'.$this->Html->link(__('My Task'), ['controller'=> 'tasks', 'action' => 'index'], ['escape'=>false]).'</li>';
								echo '<li>'.$this->Html->link(__('My Forum'), ['controller'=> 'DepartmentsForums', 'action' => 'index'], ['escape'=>false]).'</li>';
								echo '<li>'.$this->Html->link(__('My Wiki'), ['controller'=> 'wiki', 'action' => 'index'], ['escape'=>false]).'</li>';
								// echo '<li>'.$this->Html->link(__('My Activities'), ['action' => '#'], ['escape'=>false]).'</li>';
								//echo '<li>'.$this->Html->link(__('Upload File'), ['action' => '#'], ['escape'=>false]).'</li>';
								echo '</ul>';
								echo '</li>';
								echo '<li>';
								
								if($user_pro->photo){
									echo $this->Html->link(__('<span class="user-photo" style="background-image: url('.$this->Url->build(DS.'files'.DS.'Users'.DS.'photo'.DS.'small-'.$user_pro->photo, true).')"></span><span>'.$activeUser['first_name'].' '.$activeUser['last_name'].'</span>'), ['action' => '#'], ['escape'=>false]);
								}else{
									echo $this->Html->link(__('<span class="user-photo" style="background-image: url('.$this->Url->build('/img/dummy.png', true).')"></span><span>'.$activeUser['first_name'].' '.$activeUser['last_name'].'</span>'), ['action' => '#'], ['escape'=>false]);
								}
								
								echo '<ul class="menu text-left">';
								echo '<li>'.$this->Html->link(__('Profile'), ['controller'=> 'users', 'action' => 'view', $activeUser['id']], ['escape'=>false]).'</li>';
								echo '<li>'.$this->Html->link(__('My Dashboard'), ['controller'=> 'pages', 'action' => 'dashboard'], ['escape'=>false]).'</li>';
								echo '<li>'.$this->Html->link(__('Log Out'), ['controller'=> 'users', 'action' => 'logout', 'prefix'=>false], ['escape'=>false]).'</li>';
								echo '</ul>';
								echo '</li>';
								echo '</ul>';
						
								
								echo '</div>';
					?>
		        </div>
		    </div>
			<!-- start of top bar -->
			<div class="large-12 columns top-bar">
				<div class="row">
			  	  <div class="top-bar-title">
			  	    <span data-responsive-toggle="responsive-menu" data-hide-for="medium">
			  	      <button class="menu-icon" type="button" data-toggle></button>
			  	    </span>
			  	  </div>
			  	  <div id="responsive-menu">
			  	    <div class="top-bar-center">
			  	      <ul class="dropdown menu" data-dropdown-menu>
  			  			<li>
							<a href="<?= $this->Url->build('/', true); ?>"><span class="fa fa-globe"></span> <span></span></a>
  			  			</li>
			  	        <li <?php if($this->fetch('title') == 'Home'){echo 'class="active"'; } ?>>
			  				<?= $this->Html->link(__('<span class="fa fa-home"></span> <span>Home</span>'), ['controller'=> 'pages', 'action' => 'index'], ['escape'=>false]) ?>
			  			</li>
			  			<li <?php if($this->fetch('title') == 'Projects'){echo 'class="active"'; } ?>>
			  				<?= $this->Html->link(__('<span class="fa fa-tasks"></span> <span>Projects</span>'), ['controller'=> 'DepartmentProjects', 'action' => 'index'], ['escape'=>false]) ?>
			  			</li>
			  			<li <?php if($this->fetch('title') == 'News'){echo 'class="active"'; } ?>>
			  				<?= $this->Html->link(__('<span class="fa fa-newspaper-o"></span> <span>News</span>'), ['controller'=> 'DepartmentNews', 'action' => 'index'], ['escape'=>false]) ?>
			  			</li>
			  	        <li <?php if($this->fetch('title') == 'Events'){echo 'class="active"'; } ?>>
			  				<?= $this->Html->link(__('<span class="fa fa-calendar"></span> <span>Events</span>'), ['controller'=> 'DepartmentEvents', 'action' => 'index'], ['escape'=>false]) ?>
			  			</li>
			  	        <li <?php if($this->fetch('title') == 'Forum'){echo 'class="active"'; } ?>>
			  				<?= $this->Html->link(__('<span class="fa fa-square-o"></span> <span>Forum</span>'), ['controller'=> 'DepartmentForums', 'action' => 'index'], ['escape'=>false]) ?>
			  			</li>
			  	        <li <?php if($this->fetch('title') == 'Wiki'){echo 'class="active"'; } ?>>
			  				<?= $this->Html->link(__('<span class="fa fa-wikipedia-w"></span> <span>wiki</span>'), ['controller'=> 'DepartmentWiki', 'action' => 'index'], ['escape'=>false]) ?>
			  			</li>
			  			<li <?php if($this->fetch('title') == 'Media'){echo 'class="active"'; } ?>>
			  				<?= $this->Html->link(__('<span class="fa fa-folder-o"></span> <span>Media</span>'), ['controller'=> 'DepartmentMedia', 'action' => 'index'], ['escape'=>false]) ?>
			  			</li>
			  			<li <?php if($this->fetch('title') == 'Requests'){echo 'class="active"'; } ?>>
			  				<?= $this->Html->link(__('<span class="fa fa-exchange"></span> <span>Requests</span>'), ['controller'=>'Requests', 'action' => 'index'], ['escape'=>false]) ?>
			  			</li>
			  	      </ul>
			  	    </div>
			  	  </div>
				</div>
			</div>
			<!-- end of top bar -->
			<script type="text/javascript" charset="utf-8" src="/webroot/cometchat/js.php?ext=js"></script>
			<link type="text/css" charset="utf-8" rel="stylesheet" media="all" href="/webroot/cometchat/css.php?ext=css" />
			<?php 
			
				}

			}
		?>
		</header>
	</div>
</div>
<div class="large-12 columns banner-mini">
	<div class="row">
		<?php
			echo '<div class="large-12 columns department-signboard">';
			echo '<span class="department-logo" style="background-color: #004A80"></span><h6>'.$department_data->name.'</h6>';
			echo '</div>';
		?>
	</div>
</div>
<div class="medium-12 columns panel-wrap">
	<div class="large-12 columns panel-wrap">
		<?= $this->Flash->render() ?>
	</div>
</div>