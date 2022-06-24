<?php 
require '../includes/session.php';
/* This File handles all the functionality of the Admin in respect to adding  Users*/
// the request types it handles are as follow
// 1. Adding of Users - with $_GET['add']
// 2. Updating of Users - with $_GET['edit']
// 3. Deleting of Users - with $_GET['delete']
// 4. Updating Photo of Users - with $_GET['update_photo']

if (isset($_GET['add'])) {
	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$location = $_POST['address'];
		$phone = $_POST['contact'];
		$now = date('Y-m-d');
		if ($user->CheckIfEmailIsTaken($email) == true) {
				$_SESSION['error'] = 'Email already taken';
			}else{
				$filename = $_FILES['photo']['name'];			
				if(!empty($filename)){
					move_uploaded_file($_FILES['photo']['tmp_name'], '../../images/users/'.$filename);	
				}
				$user->register($email,md5($password),$firstname,$lastname,$location,$phone,$now,$filename);
		        $_SESSION['success'] = 'Account created successfully. ';  
			}
	}
	else{
		$_SESSION['error'] = 'Fill up user form first';
	}
	header('location: '.Url_Admin.'users.php');	
}

/* Handles Editing pf Users*/
if (isset($_GET['edit'])) {
	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];

		$row = User::get('users',$id);
		
		if($password == $row['password']){
			$password = $row['password'];
		}
		else{
			$password = md5($password);
		}
			Admin::update($email,$firstname,$lastname,$password,$id,$filename,$address,$contact);
			$_SESSION['success'] = 'User updated successfully';
	}
	else{
		$_SESSION['error'] = 'Fill up edit user form first';
	}

	header('location: '.Url_Admin.'users.php');
}

/* Handles Deleting of Users*/
if (isset($_GET['delete'])) {
	if(isset($_POST['delete'])){
			$id = $_POST['id'];
			
			Admin::delete($id);

			$_SESSION['success'] = 'User deleted successfully';
		
	}
	else{
		$_SESSION['error'] = 'Select user to delete first';
	}

	header('location: '.Url_Admin.'users.php');
}
/* Handles Updating Photo*/
if (isset($_GET['update_photo'])) {
	if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../../images/users/'.$filename);	
		}

			ADmin::updatePhoto($filename,$id);
			$_SESSION['success'] = 'User photo updated successfully';
		

	}
	else{
		$_SESSION['error'] = 'Select user to update photo first';
	}

	header('location: '.Url_Admin.'users.php');
}

 ?>