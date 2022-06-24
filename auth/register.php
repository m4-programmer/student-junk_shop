<?php 

require '../required.php';
if (isset($_POST['signup'])) {
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		$location = $_POST['location'];
		$phone = $_POST['phone'];
		$now = date('Y-m-d');

		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;

		$_SESSION['location'] = $location;
		$_SESSION['phone'] = $phone;

		if($password != $repassword){
			$_SESSION['error'] = 'Passwords did not match';
			header('location: ../signup.php');
		}
		else{
			if ($user->CheckIfEmailIsTaken($email) == true) {
				$_SESSION['error'] = 'Email already taken';
				header('location: ../signup.php');
			}else{
				$user->register($email,md5($password),$firstname,$lastname,$location,$phone,$now);
				unset($_SESSION['firstname']);
		        unset($_SESSION['lastname']);
		        unset($_SESSION['email']);
		        unset($_SESSION['location']);
		        unset($_SESSION['phone']);

		        $_SESSION['success'] = 'Account created successfully. ';
		        $_SESSION['email'] = $user->email;
		        header('location: ../login.php?');
			}
		}
}
else{
		$_SESSION['error'] = 'Fill up signup form first';
		header('location: ../signup.php');
	}

 ?>