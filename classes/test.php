<?php 
include 'Db.php';
include 'User.php';

//use classes\Db;
class test 
{
	
	function __construct()
	{
		$say = new Db;
		User::login('miraboy13@gmail.com','12345');
	}
	public function hello($value)
	{
		echo "helo am a $value";
	}
}
$test = new test;

 ?>