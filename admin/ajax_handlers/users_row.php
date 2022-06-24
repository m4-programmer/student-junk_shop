<?php 
// This File is important, it is accessed by the ajax request sent from users.php; with the javascript function - getRow(id);
	include '../includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$row = User::get('users',$id);//holds the details of the user with the defined $id
		

		echo json_encode($row);
	}
?>