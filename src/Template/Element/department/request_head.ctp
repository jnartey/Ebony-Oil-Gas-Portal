<div class="large-12 columns">
	<?php
		echo $this->Html->link(__('Leave Request'), ['controller' => 'Requests', 'action' => 'index'], ['class'=>'button small', 'escape'=>false]);
		echo '&nbsp;';
		echo $this->Html->link(__('Work Outside Work Schedule'), ['controller' => 'WorkOutsideSchedules', 'action' => 'index'], ['class'=>'button small', 'escape'=>false]);
		echo '&nbsp;';
		echo $this->Html->link(__('Cash/Cheque Request'), ['controller' => 'CashRequests', 'action' => 'index'], ['class'=>'button small', 'escape'=>false]);
		echo '&nbsp;';
		echo $this->Html->link(__('Vehicle Servicing'), ['controller' => 'VehicleServicings', 'action' => 'index'], ['class'=>'button small', 'escape'=>false]);
		echo '<br /><br />';
	?>
</div>