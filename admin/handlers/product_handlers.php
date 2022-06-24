<?php
	include '../includes/session.php';
	include '../includes/slugify.php';
	// handles adding of product
	if (isset($_GET['add'])) {
		if(isset($_POST['add'])){
		$name = $_POST['name'];
		$slug = slugify($name);
		$category = $_POST['category'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$filename = $_FILES['photo']['name'];
		if(Product::is_product_taken($slug) == true){
			$_SESSION['error'] = 'Product already exist';
		}
		else{
			if(!empty($filename)){
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$new_filename = $slug.'.'.$ext;
				move_uploaded_file($_FILES['photo']['tmp_name'], '../../images/'.$new_filename);	
			}
			else{
				$new_filename = '';
			}

			$createProduct = Product::create(Admin::Auth()->id, $category, $name, $description, $slug, $price, $new_filename);
			if ($createProduct == true) {
				$_SESSION['success'] = 'Product added successfully';
			}else{
				$_SESSION['error'] = 'Product could not be added ';
			}
			
		}

		
	}
	else{
		$_SESSION['error'] = 'Fill up product form first';
	}

	header('location: '.Url_Admin.'products.php');
	}
	// Handles Editing and Updating of Products
	if (isset($_GET['edit'])) {
		if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$slug = slugify($name);
		$category = $_POST['category'];
		$price = $_POST['price'];
		$description = $_POST['description'];

		$edit = Product::update($category, $name, $description, $slug, $price,$id);
		if ($edit == true) {
			$_SESSION['success'] = 'Product updated successfully';
		}else{
			$_SESSION['error'] = "Error Updating Product";
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit product form first';
	}

	header('location: '.Url_Admin.'products.php');
	}
	//Delete product by Id
	if (isset($_GET['delete'])) {
		if(isset($_POST['delete'])){
		$id = $_POST['id'];
		Product::delete($id);	
		$_SESSION['success'] = 'Product deleted successfully';
	}
	else{
		$_SESSION['error'] = 'Select product to delete first';
	}

	header('location: '.Url_Admin.'products.php');
	}
	// Handles Updating Product Image
	if (isset($_GET['upload'])) {
		if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];

		$product = Product::fetch_product_by($id);
		
		if(!empty($filename)){
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$new_filename =$product->slug.'_'.time().'.'.$ext;
			
			move_uploaded_file($_FILES['photo']['tmp_name'], '../../images/'.$new_filename);	
		
		}else{
			$new_filename = '../images/'.$product->photo;
		}
		echo $new_filename;
			Product::updatePhoto($new_filename,$id);
			$_SESSION['success'] = 'Product photo updated successfully';
	
	}
	else{
		$_SESSION['error'] = 'Select product to update photo first';
	}

	header('location: '.Url_Admin.'products.php');
	}
?>