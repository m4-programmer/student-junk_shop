<?php 
include '../includes/session.php';

// This block delete's A Cart Entry
if(isset($_POST['delete'])){
		$userid = $_POST['userid'];
		$cartid = $_POST['cartid'];
		
		Cart::delete($cartid);
		$_SESSION['success'] = 'Product deleted from cart';
	
		header('location: '.Url_Admin.'cart.php?user='.$userid);
	}

	// 
 ?>