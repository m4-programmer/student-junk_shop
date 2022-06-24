<?php
	include 'includes/conn.php';
	//session_start();

	// if(isset($_SESSION['admin'])){
	// 	header('location: admin/home.php');
	// }
	include 'required.php';	

	if(isset($_SESSION['user']) or isset($_SESSION['admin'])){
		
		$id = (isset($_SESSION['admin']) and $_SESSION['admin'] != '') ? $_SESSION['admin'] : $_SESSION['user'];
		$user = User::get('users',$id); // we fetch authenticated user details as an array;
		
	}
?>