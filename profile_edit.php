<?php
	include 'includes/session.php';

	$conn = $pdo->open();

	if(isset($_POST['edit'])){
		$curr_password = $_POST['curr_password'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$photo = $_FILES['photo']['name'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		if($user['password'] == md5($curr_password)){
			if(!empty($photo)){
				move_uploaded_file($_FILES['photo']['tmp_name'], 'images/users/'.$photo);
				$filename = $photo;	
			}
			else{
				$filename = $user['photo'];
			}

			if($password == $user['password']){
				$password = $user['password'];
			}
			else{
				$password = md5($password);
			}

			Admin::update($email,$firstname,$lastname,$password,$user['id'],$filename,$address,$contact);
				$_SESSION['success'] = 'Account updated successfully';
		}
		else{
			$_SESSION['error'] = 'Incorrect password';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up required details first';
	}

	header('location: profile.php');

?>