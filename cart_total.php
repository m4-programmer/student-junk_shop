<?php
	include 'includes/session.php';

	if(isset($_SESSION['user'])){
		//$total = Product::sales();

		echo json_encode($total);
	}
?>