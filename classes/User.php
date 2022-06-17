<?php 

/**
 * 
 */
class User extends Db
{
	public $db; 
	public $name;
	public function __construct()
	{
		 $this->db = parent::__construct();
		  
	} 
	public  static function login($email,$password){
		$db =new Db;
		//check if email has been taken 
		$user =  $db->fetch('users','','email = ? AND password = ?',array( $email,$password),'','','');

		if (count($user) > 0 ) {
			if ($user[0]['type'] == 1)
			{
				echo $user[0]['type'];
				$_SESSION['admin'] = $row['id'];
			}
			else
			{
				$_SESSION['user'] = $row['id'];
			}
		}
		else{
				$_SESSION['error'] = 'Incorrect Password';
				// return 0;
				echo 'Incorrect Password';
		}
					
		return $user;
	}
	public function Logout_Log($uid){
		// first select the last entry in the database for the user.
		$res = $this->fetch('userlog','','userId = ?',$uid,'loginTime DESC','','');
		$no = $res[0]['id'];
		$logout_time = date('Y-m-d h:i:s a', time());
		$this->query('UPDATE userlog SET logout_time = :now Where userId = :uid and loginTime = :login_time ');
		$this->bind(':uid', $uid );
		$this->bind(':now', $logout_time );
		$this->bind(':login_time', $_SESSION['login_time']);
		$this->execute();
		//unset($_SESSION['login_time']);
		return $res;
	}
	public function fetchProfileDetails($userid){
		 $res=$this->fetch('user','','userid = ?',$userid,'','','');
		 return $res;
	}
	public function fetch_password($userId,$oldpass){
		$username = $this->getname($userId);
		$fusername = $username[0]['username'];
		$user =  $this->fetch('user','','username = ? AND password = ?',array( $fusername,$oldpass),'','','');
		return $user ;						
	}
	public function change_password($np,$update,$userId,$oldpass){
		//$con="update user set password=?  where id=? and password = ?";
		$this->query("UPDATE user set password= :a,password_update_time=:b where userid=:c and password=:d");
		$this->bind(':a', $np);
		$this->bind(':b', $update);
		$this->bind(':c', $userId);
		$this->bind(':d', $oldpass);
		$this->execute();
		
	}

	public function update_profile($fname,$uname,$gender,$number,$udate,$userid,$pics){
		$this->query("UPDATE user set username=:a,uname=:b,gender=:c,number=:d,updationDate=:e,photo =:f where userid=:g");
		$this->bind(':a', $uname);
		$this->bind(':b', $fname);
		$this->bind(':c', $gender);
		$this->bind(':d', $number);
		$this->bind(':e', $udate);
		$this->bind(':f', $pics);
		$this->bind(':g', $userid);
		$this->execute();
		
	}
	public function check_login(){
		
			if(!isset($_SESSION['id']))
				{	
					$host = $_SERVER['HTTP_HOST'];
					$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
					$extra="index.php";		
					$_SESSION["id"]="";
					header("Location: http://$host$uri/$extra");
					exit();
				}
	}
	public function CheckIfUsernameIsTaken($uname){
		return $this->fetch('user','','username = ? ', $uname,'','','');
	}
	public function CheckIfEmailIsTaken($email){
		$email =  $this->fetch('user','','email = ? ', $email,'','','');
		if (count($email) > 0) {
			return true;
		}else{
			return false;
		}
	}
	public function fetchUserLog($userid){
		return $this->fetch('userlog','','userId = ? ', $userid,'','','');
	}
	public function register($fname,$username,$fpassword,$gender,$number,$email){
		// register users
		$register = $this->insert('user',array('uname', 'username', 'password','gender','number','email','access'),array($fname,$username,$fpassword,$gender,$number,$email, 2));
		// fetch register user details
		 $regsteredUser = $this->fetch('user','','username = ? AND password = ?',array( $username,$fpassword),'','','');

			 $_SESSION['username'] = $regsteredUser[0]['username'];

			
			 return header("location: index.php");
	}
	public static function findfriends(){
		$db =new Db;
		$db->query('SELECT * FROM user where userid != :id and access = :access ');
		$db->bind(':access','2');
		$db->bind(':id',$_SESSION['id']);
		$fetch = $db->fetchresult();
		return $fetch;
	}
	public static function conn(){
		$db =new Db;
		return $db;
	}
	public static function addFriend($friend_username){
		$db = User::conn();
		if (isset($_GET['action']) and isset($_GET['id'])) {
			// check if user is already friend
			$result = $db->fetch('friends','','user_id = ? AND friend_id = ?',array( $_SESSION['id'],$_GET['id']),'','','');
			if (count($result) > 0) {
				return false;
				// if it returns false then insert friend id to friends table else don't
				}else{
					// else add user as friend
		 	$db->insert('friends',array('id','user_id','friend_id','date'),array('',$_SESSION['id'],$_GET['id'],date("Y/m/d h:i:s a") ));
		 	$_SESSION['successmsg'] = "<b>$friend_username</b> added successfully";

		 	return true;
				}
		
			
		 } 
	}
	public static function myfriends(){
		$db = new Db;
		$db->query('SELECT * FROM `user` INNER JOIN friends ON userid = friends.user_id where userid = :id');
		$db->bind(':id', $_SESSION['id']);
		$res = $db->fetchresult();
		if (count($res) < 1) {
			return false;
		}else{
			return $res;
		}
		
	}

	public static function checkfriends(){
		$db = new Db;
		$res = $db->fetch('friends','','user_id = ?',$_SESSION['id'] ,'','','');
		//$res = $db->fetch('friends','','user_id = ? and friend_id = ?',array($_SESSION['id'], $friend_id ),'','','');
		return $res;
	}
	
	public static function getname($id){
		// fetch messages
		$db = new Db;
		$db->query("SELECT * from user where userid=:id");
		$db->bind(':id', $id);
		$res = $db->fetchresult();
		return $res;
		}

	public static function timeago($curr_time){
			$time = strtotime($curr_time);
			// converts timestamp to time ago
			//calculates the difference btw current current time and given timestamp in seconds
			$diff = time() - $time;
			//echo time().' diff is:'.$diff.' dbtime is:'.$time;
			// time difference in seconds
			$sec = $diff;
		

			// convert time difference in minues
			$min = round($diff/60);
			// convert time difference in hours
			$hrs = round($diff / 3600);

			// convert time difference in days
			$days = round($diff/86400);

			// convert time difference in weeks
			$weeks = round($diff/604800);
			// convert time difference in months
			$mnths = round($diff/2600640);

			// convert time difference in yrs
			$yrs = round($diff/31207680);

			//check for seconds
			if ($sec <= 60) {
				return "$sec seconds ago";
			}elseif ($min <=60) {
				if ($min == 1) {
					return "one minute ago";
				}else{
					return "$min minutes ago";
				}
			}
			// chec for hours
			elseif ($hrs <= 24) {
				if ($hrs == 1) {
					return("an hour ago");
				}else{
					return("$hrs hours ago");
				}
			}
			//check for days
			elseif ($days <= 7) {
				if ($days == 1) {
					return("yesterday");
				}else{
					return("$days days ago");
				}
			}
			// check for weeks
			elseif ($weeks <= 4.3) {
				if ($weeks == 1) {
					return("a week ago");
				}else{
					return("$weeks weeks ago");
				}
			}
			//check for months
			elseif ($mnths <= 12) {
				if ($mnths == 1) {
					return("a month ago");
				}else{
					return("$mnths months ago");
				}
			}
			// check for years
			else{
				if ($yrs == 1) {
					return "one year ago";
				}else{
					return "$yrs years ago";
				}
			}
		} 
	
	

}
 ?>