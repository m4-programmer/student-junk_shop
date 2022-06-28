
<?php 

/**
 * The Class contains the Following Methods
 * 1. register; 2. login; 3. get; 4.update_profile; 5. CheckIfEmailIsTaken
 * 
 */
class User extends Db
{
	
	public $db; 
	public $name;
	public $email;
	 public static  $auth_email;
	public static $number = 123;
	public function __construct()
	{
		 $this->db = parent::__construct();
		  
	} 
	
	/* Registration Method*/
	public function register($email,$password,$fname,$lname,$address,$phone,$time,$image=null){
		// register users
		if ($image == "") {
			$register = $this->insert('users',array('email', 'password','type','firstname','lastname','address','contact_info','status','created_on'),array($email,$password,0,$fname,$lname,$address,$phone,1,$time));
		}else{
			$register = $this->insert('users',array('email', 'password','type','firstname','lastname','address','contact_info','status','created_on','photo'),array($email,$password,0,$fname,$lname,$address,$phone,1,$time,$image));
		}	
		if ($this->lastinsertid()) {
			$this->email = $email;
			return true;
		}
	}
	public  static function login($email,$password){
		$db =new Db;
		//check if email has been taken 
		$user =  $db->fetch('users','','email = ? AND password = ?',array( $email,$password),'','','');
		User::$number = 242323;
		if (count($user) > 0 ) {
			User::$auth_email = $email;
			$_SESSION['auth'] = $user[0]['id'];
			return $user;
		}
		else{
			return false;
		}
	}
	
	//fetch all the entries in the database based on the table name
	public static function get($tablename,$id=null){
		$db = new DB;
		if (is_null($id)) {
			$db->query("SELECT * from $tablename");
		}else{
			$db->query("SELECT * from $tablename where id = :id");
			$db->bind(':id',$id);
			return $db->fetchsingle();
		}
		
		return $db->fetchresult();
	}

	public static function update_profile($email,$fname,$lname,$pword,$userid,$pics,$address,$phone,$whatsapp){
		$db = new DB;
		
			$db->query("UPDATE users set email=:email,firstname=:fname,lastname=:lname, password=:pword,photo =:pics, address=:address, contact_info=:phone, whatsapp = :whatsapp where id=:id");
		
		$db->bind(':email', $email);
		$db->bind(':fname', $fname);
		$db->bind(':lname', $lname);
		$db->bind(':pword', $pword);
		$db->bind(':pics', $pics);
		$db->bind(':id', $userid);

		$db->bind(':address', $address);
		$db->bind(':phone', $phone);
		$db->bind(':whatsapp', $whatsapp);
		$db->execute();
		return true;
	}

	public function CheckIfEmailIsTaken($email){
		$email =  $this->fetch('users','','email = ? ', $email,'','','');
		if (count($email) > 0) {
			return true;// if true then email has been taken
		}else{
			return false;//if false then email has not been taken
		}
	}
	// Update my_product column in db for a unique user
	public static function update_my_product($my_product_total,$the_seller){
		$db = new DB;
		
		$db->query("UPDATE users set my_product=:my_product_total where id=:the_seller");
		
		$db->bind(':my_product_total', $my_product_total);
		$db->bind(':the_seller', $the_seller);
		
		$db->execute();
		return true;
	}
	
}
 ?>