
<?php 

require '../required.php';

//$user->query()

if(isset($_POST['login'])){
		
		$email = $_POST['email'];
		$password = $_POST['password'];
		$login = $user->login($email,md5($password));

		if ( $login != false) {
			if ($login[0]['type'] == 1)
			{
				
				$_SESSION['admin'] = $login[0]['id'];
				
			}
			else
			{
				$_SESSION['user'] = $login[0]['id'];
				$_SESSION['email'] = $login[0]['email'];
			}
		}else{
			$_SESSION['error'] = 'Incorrect Login Details';
		}


}else{
	$_SESSION['error'] = 'Input login credentails first';
}
header('location: ../login.php');

 ?>