<?php
	try {
		$a =  '../../includes/conn.php';
		$b =  '../../required.php';	
		$c =  '../includes/conn.php';
		$d =  '../required.php';	
		$list_Url = [$a,$b,$c,$d];
		foreach ($list_Url as $key ) {
			if (file_exists($key)) {
			require $key;
		}
		}
		
		
	} catch (Exception $e) {
		
	}
	
	       		
	$admin->is_auth( $_SESSION['auth'] );// checks if user has been authenticated, if not authenticated returns the user to back to the homepage
	$id = (isset($_SESSION['admin']) and $_SESSION['admin'] != '') ? $_SESSION['admin'] : $_SESSION['user'] ; // set's the authenticated user id
	$admin = User::get('users',$id); // we fetch authenticated user details as an array;
	//Any where you see $admin it reading this.
	

?>