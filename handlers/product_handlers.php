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
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$new_filename);	
			}
			else{
				$new_filename = '';
			}

			$createProduct = Product::createProduct(Admin::Auth()->id, $category, $name, $description, $slug, $price, $new_filename);
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

	header('location: products.php');
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

		$edit = Product::updateProduct($category, $name, $description, $slug, $price);
		if ($edit == true) {
			$_SESSION['success'] = 'Product updated successfully';
		}else{
			$_SESSION['error'] = "Error Updating Product";
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit product form first';
	}

	header('location: products.php');
	}

?>