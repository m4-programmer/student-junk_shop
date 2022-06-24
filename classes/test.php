<?php 
include 'Db.php';
include 'User.php';

//use classes\Db;
class test extends User
{
//	public static $name;
	function __construct()
	{
		$say = new Db;
		User::login('miraboy13@gmail.com','12345');
	}
	public function hello($value)
	{
		echo "helo am a $value";
	}
	public static function name($name){
		self::$name = $name;
		echo 'done';
	}
	public function fetchs()
	{
		// $this->query("SELECT * from users");
		// $this->fetchobj();
		return User::get('users');
	}
}
$test = new test;
//test::name('hello');
//echo test::$name;
print_r($a = $test->fetchs());
echo $a->password;

 ?>

 	