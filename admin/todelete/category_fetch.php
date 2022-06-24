<?php
	include 'includes/session.php';

	$output = '';

	$cat = Category::fetch_category();
	foreach($cat as $row){
		$output .= "
			<option value='".$row->id."' class='append_items'>".$row->name."</option>
		";
	}

	
	echo json_encode($output);

?>