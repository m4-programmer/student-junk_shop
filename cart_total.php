<?php
	include 'includes/session.php';
	// nt usful
	if(isset($_SESSION['user'])){
		$total = Product::sales();

		echo json_encode($total);
	}
?>