<?php 

/**The Class contains the Following Methods
 * 1. is_auth; 2. Auth; 3. fetchAllUsers; 4. update [update user profile details]
 */
class Admin extends Db
{
	
	function __construct()
	{
		$this->db = parent::__construct();
	}

	public function is_auth($user)
	{
		//if user has not login this method will return the user back to the home page
		if(!isset($user)){
		header('location: '.Url);
		exit();
		}
	}

	public static function Auth(){
		$db = new Db;
		$db->query('SELECT * from users where id = :id');
		$db->bind(':id', $_SESSION['auth']);
		return $db->fetchobj();
	}
	/*Admin CRUD functionality*/
	//1.  Create Users
	// it is implemented by Users -> register method
	// 2. Read/Retrieve Users
	public static function fetchAllUsers(){
		$db = new Db;
		return $db->fetch('users','','type = ?',0,'','','',true);// RETURNS AN OBJECT
	}
	// 3. Update Users
	public static function update($email,$fname,$lname,$pword,$userid,$pics,$address,$phone,$whatsapp){
		User::update_profile($email,$fname,$lname,$pword,$userid,$pics,$address,$phone,$whatsapp);
		return true;
	}
	public static function updatePhoto($photo,$id){
		$db = new DB;
		$db->query("UPDATE users SET photo=:photo WHERE id=:id");
		$db->bind(':photo',$photo);
		$db->bind(':id',$id);
		$db->execute();
		return true;
	}
	// 4. Delete Users
	public static function delete($id){
		$db = new Db;
		$db->query('DELETE FROM users WHERE id=:id');
		$db->bind(':id',$id);
		$db->execute();
	}

	


	// public function fetchusers(){
	// 	return $this->fetch('user','','','','','','');

	// }
	public function blockuser($id){
		$this->query('UPDATE user set status = 1 where userid = :id');
		$this->bind(':id', $id);
		$this->execute();
	}
	public function unblockuser($id){
		$this->query('UPDATE user set status = 0 where userid = :id');
		$this->bind(':id', $id);
		$this->execute();
	}
	public function reports()
	{
		return $this->fetch('reports','','','','','','');
	}
	public function blockedusers(){
		// if status == 0 user has been flag for blocking by Admin
		return $this->fetch('user','','status = ?','1','','','');
	}
	public function fetchlog(){
		return $this->fetch('userlog','',' ', '',' logout_time ','','');
	}

	// if i use the method below, i will delete this comment
	public function getUsername($user)
	{
		$this->query("SELECT * from user where userid=:id");
		$this->bind(':id', $user);
		$res = $this->fetchresult();
		$username = $res[0]['username']; 
		return $username;
	}
}

 ?>