<?php 

/**
 * 
 */
class Cart 
{
	
	public static function fetch_cart($id = null){
		$db = new Db;
		if ($id == null) {
			$db->query("SELECT *, cart.id AS cartid FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE sold=:sold");
			$db->bind(':sold','yes');

		}else{
			$db->query("SELECT *, cart.id AS cartid FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
			$db->bind(':user_id',$id);
		}
		return $db->fetchresult();
	}

	// Delete Cart Entries
	public static function delete($id){
		$db = new DB;
		$db->query("DELETE FROM cart WHERE id=:id");
		$db->bind(':id',$id);
		$db->execute();
		return true;
	}
	
}
 ?>