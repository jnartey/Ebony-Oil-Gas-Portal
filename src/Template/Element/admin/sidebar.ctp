<div class="off-canvas position-left" id="offCanvas" data-content-scroll data-off-canvas>
	<!-- Close button -->
	<div class="large-12 columns icon-section">
		<a class="close-button" aria-label="menu" data-toggle="offCanvas">
			<span class="menu-icon dark"></span>
		</a>
	</div>

	<div class="large-12 columns menu-section">
	    <!-- Menu -->
	    <ul class="vertical menu">
			<li <?php if($this->fetch('title') == 'Dashboard'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-th-large"></span> <span class="menu-txt">Dashboard</span>'), ['controller'=> 'pages', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
			<li <?php if($this->fetch('title') == 'Users'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-users"></span> <span class="menu-txt">Users</span>'), ['controller'=> 'users', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
			<li <?php if($this->fetch('title') == 'Departments'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-puzzle-piece"></span> <span class="menu-txt">Departments</span>'), ['controller'=> 'departments', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
	        <li <?php if($this->fetch('title') == 'Workgroups'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-object-group"></span> <span class="menu-txt">Workgroups</span>'), ['controller'=> 'workgroups', 'action' => 'index'], ['escape'=>false]) ?>
	        <li <?php if($this->fetch('title') == 'Events'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-calendar"></span> <span class="menu-txt">Events</span>'), ['controller'=> 'events', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
			<li <?php if($this->fetch('title') == 'Projects'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-tasks"></span> <span class="menu-txt">Projects</span>'), ['controller'=> 'projects', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
			</li>
			<li <?php if($this->fetch('title') == 'Canteen'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-cutlery"></span> <span class="menu-txt">Canteen</span>'), ['controller'=> 'canteen', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
			<li <?php if($this->fetch('title') == 'News'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-newspaper-o"></span> <span class="menu-txt">News</span>'), ['controller'=> 'news', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
			<!-- <li <?php if($this->fetch('title') == 'Media'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-folder-o"></span> <span class="menu-txt">Media</span>'), ['controller'=> 'media', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
			<li <?php if($this->fetch('title') == 'Forum'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-square-o"></span> <span class="menu-txt">Forums</span>'), ['controller'=> 'departments-forums', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
			<li <?php if($this->fetch('title') == 'Wiki'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-wikipedia-w"></span> <span class="menu-txt">Wiki</span>'), ['controller'=> 'wiki', 'action' => 'index'], ['escape'=>false]) ?>
			</li> -->
			<li <?php if($this->fetch('title') == 'Holidays'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-sun-o"></span> <span class="menu-txt">Holidays</span>'), ['controller'=> 'Holidays', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
			<li <?php if($this->fetch('title') == 'Leave Days'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-pagelines"></span> <span class="menu-txt">Leave Days</span>'), ['controller'=> 'LeaveDays', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
			<li <?php if($this->fetch('title') == 'Request Administrators'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-dot-circle-o"></span> <span class="menu-txt">Request Admin</span>'), ['controller'=> 'RequestHandlers', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
			<li <?php if($this->fetch('title') == 'Vehicles'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-car"></span> <span class="menu-txt">Vehicles</span>'), ['controller'=> 'Vehicles', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
			<li <?php if($this->fetch('title') == 'Banners'){echo 'class="active"'; } ?>>
				<?= $this->Html->link(__('<span class="fa fa-image"></span> <span class="menu-txt">Banners</span>'), ['controller'=> 'Banners', 'action' => 'index'], ['escape'=>false]) ?>
			</li>
	    </ul>
	</div>
</div>
