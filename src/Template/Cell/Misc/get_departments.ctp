<?php
	$names = null;
	if(!empty($department_ch)){
		foreach($department as $data):
			$names[] = $data->department->name;
		endforeach;
	
		echo implode(', ', $names);
	}
?>