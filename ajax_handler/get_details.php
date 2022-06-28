<?php 
require '../required.php';

// THIS FILE CHECK IF A VISITOR REQUESTING FOR THE SELLER PHONE NUMBER OR TO CHAT WITH THE SELLER HAS BEEN AUTHENTICATED;
// It is accessed by product.php 


	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$msg = '';
		$product = Product::Product_Category_User($id);
		if (!isset($_SESSION['user']) and !isset($_SESSION['admin'])) {
			$msg = 0;//meaning the user requesting for the contact info has not login
		}else{
			$msg = 1;//meaning that the user has login
		}
		$sellernumber = $product['contact_info'];
		$whatsapp = $product['whatsapp']; //gets the seller whatsapp address
		$data = ['msg'=>$msg,'number'=>$sellernumber,'whatsapp'=>$whatsapp];// put all the required details in array
		//$data = ['msg'=>1,'number'=>34];
		
		echo json_encode($data);// send the array as a json file for the ajax request
	}
 ?>