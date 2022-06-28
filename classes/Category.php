<?php 

/**
 * 
 */
class Category 
{
	
	public static function fetch_category($id=null)
	{
		$db = new DB;
		if ($id == "") {
			return $db->fetch('category','','','','','','', true);
		}else{
			$db->query("SELECT * from category where id =:id");
			$db->bind(':id',$id);
			return $db->fetchsingle();
		}
		
		
	}
	public static function fetch_by_slug($slug)
	{
		$db = new DB;
		$db->query("SELECT * from category where cat_slug =:slug");
		$db->bind(':slug',$slug);
		return $db->fetchsingle();
			
	}

	// it returns true or false depending if the category name has been taken or not
	public static function is_unique($name){
		$db = new Db;
		$is_taken =  $db->fetch('category','','name = ?',$name,'','','', true);
		if (count($is_taken) > 0) {
			return true;//meaning name has been taken
		}else{
			return false;//meaning name has not been taken
		}
	}
	public static function create($name,$cat_slug){
		$db = new Db;
		$db->insert('category', array('name', 'cat_slug'),array($name,$cat_slug));
		if ($db->lastinsertid()) {
			return true;
		}else{
			return false;
		}
	}
	public static function update($name,$cat_slug,$id){
		$db = new Db;
		$db->query("UPDATE category SET name=:name, cat_slug=:cat_slug WHERE id=:id");
		$db->bind(':id',$id);
		$db->bind(':name',$name);
		$db->bind(':cat_slug',$cat_slug);
		$db->execute();
	}
	public static function delete($id){
		$db = new Db;
		$db->query("DELETE FROM category WHERE id=:id");
		$db->bind(':id',$id);
		$db->execute();
	}
	

}
 ?>