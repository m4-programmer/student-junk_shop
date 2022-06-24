<?php 

/**
 * 
 */
class Product extends Db {
	public $Product_name;
	public static $db;
	public $dbs; 
	public function __construct()
	{
		Product::$db = parent::__construct();
	}
	// This method holds the logic for total sales of a user, based on the type
	// if user is admin he see's overall sale's if user is user he see's only his sales
	public static function sales()
	{
		$db = new DB;
		// if user is Admin
		if (Admin::Auth()->id == 1) {
			$db->query("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id");
			 $result = $db->fetchresult();
		}else{
			$db->query("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id where products.seller_id =:id");
			$db->bind(':id',Admin::Auth()->id);
			$result = $db->fetchresult();
		}
		$total = 0;
        foreach($result as $srow){
          $subtotal = $srow['price']*$srow['quantity'];
          $total += $subtotal;
        }
		return $total;
	}
	//fetches the product that matches a particular category and the user details that posted the product
	public static function Product_Category_User($id)
	{
		$db = new DB;
		$db->query("SELECT *, products.id AS prodid, products.name AS prodname, category.name AS catname FROM products LEFT JOIN category ON category.id=products.category_id LEFT JOIN users on products.seller_id = users.id  WHERE products.id=:id");
		$db->bind(':id',$id);
		return $db->fetchsingle();
	}
	//this method tells us if a product name has been taken by looking the slug
	public static function is_product_taken($slug)
	{
		$db = new DB;
		$slug =  $db->fetch('products','','slug = ? AND seller_id = ?',array( $slug,Admin::Auth()->id),'','','', true);
		// if product is taken return true
		if(count($slug) > 0){
			return true;
		}else{
			return false;
		} 
	}
	// This fetches all the product for the admin to see
	public static function fetch_all_product($category='')
	{
		$db = new DB;
		if ($category=='') {
			return $db->fetch('products','',' ','','','','', true);
		}else{
			return $db->fetch('products','','  category_id = ?',$category,'','','', true);
		}	
	}
	public static function fetch_user_product($category='')
	{
		$db = new DB;
		// fetches all the product sold by the authenticated user
		if ($category=='') {
			return $db->fetch('products','',' seller_id = ?',Admin::Auth()->id,'','','', true);
		}else{
			// fetches all the product sold by the authenticated user based on a particular category
			return $db->fetch('products','',' seller_id = ? and category_id = ?',array(Admin::Auth()->id, $category),'','','', true);
		}	
	}
	public static function fetch_product_by($id)
	{
		$db = new DB;
		$db->query("SELECT * from products where id = :id");
		$db->bind(':id',$id);
		return $db->fetchobj();
	}
	/*Fetches n most View Product's for the day */
	public static function fetch_most_n_product($now,$limit)
	{
		$db = new DB;
		$db->query("SELECT * FROM products WHERE date_view=:now ORDER BY counter DESC LIMIT $limit");
		$db->bind(':now',$now);
		return $db->fetchobjAll();
	}

	public static function create($user_id, $category_id, $name, $description, $slug, $price, $photo)
	{
		$db = new DB;
		$db->insert('products',array('seller_id', 'category_id','name','description','slug','price','photo'),array($user_id,$category_id,$name,$description,$slug,$price,$photo));
		if ($db->lastinsertid()) {
			return true;
		}else{
			return false;
		}
	}
	public static function update($category, $name, $description, $slug, $price,$id){
		$db = new DB;
		$db->query("UPDATE products SET name=:name, slug=:slug, category_id=:category, price=:price, description=:description WHERE id=:id");
		$db->bind(':name',$name);
		$db->bind(':slug',$slug);
		$db->bind(':category',$category);
		$db->bind(':price',$price);
		$db->bind(':description',$description);
		$db->bind(':id',$id);
		$db->execute();
		return true;
	}
	public static function delete($id){
		$db = new DB;
		$db->query("DELETE FROM products WHERE id=:id");
		$db->bind(':id',$id);
		$db->execute();
		return true;
	}
	public static function updatePhoto($photo,$id){
		$db = new DB;
		$db->query("UPDATE products SET photo=:photo WHERE id=:id");
		$db->bind(':photo',$photo);
		$db->bind(':id',$id);
		$db->execute();
		return true;
	}



}

 ?>