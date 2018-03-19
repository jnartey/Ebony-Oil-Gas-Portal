<?php
	foreach($staff as $data):
		$names[] = $data->name;
	endforeach;
	
	echo implode(', ', $names);
?>