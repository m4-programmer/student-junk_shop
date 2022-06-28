<?php
	include 'includes/session.php';

	

	$output = array('error'=>false);
	$id = $_POST['id'];

	if(isset($_SESSION['user'])){
		
			$buyer->query("DELETE FROM cart WHERE id=:id");
			$buyer->bind('id',$id);
			$buyer->execute();
			$output['message'] = 'Deleted';
			
		
	}
	else{
		foreach($_SESSION['cart'] as $key => $row){
			if($row['productid'] == $id){
				unset($_SESSION['cart'][$key]);
				$output['message'] = 'Deleted';
			}
		}
	}

	$pdo->close();
	echo json_encode($output);

?>