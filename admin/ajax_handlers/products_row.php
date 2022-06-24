<?php 
	include '../includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		// we call the method below from our Product class, to feed the ajax request that will be sent from products.php under < function getRow(id) >
		$row = Product::Product_Category_User($id); 
		echo json_encode($row);
		
	}
?>