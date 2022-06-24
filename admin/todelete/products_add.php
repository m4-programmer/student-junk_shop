<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$slug = slugify($name);
		$category = $_POST['category'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$filename = $_FILES['photo']['name'];

		// $conn = $pdo->open();

		// $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM products WHERE slug=:slug");
		// $stmt->execute(['slug'=>$slug]);
		// $row = $stmt->fetch();

		// if($row['numrows'] > 0){
		// 	$_SESSION['error'] = 'Product already exist';
		// }
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
			// try{
			// 	$stmt = $conn->prepare("INSERT INTO products (category_id, name, description, slug, price, photo) VALUES (:category, :name, :description, :slug, :price, :photo)");
			// 	$stmt->execute(['category'=>$category, 'name'=>$name, 'description'=>$description, 'slug'=>$slug, 'price'=>$price, 'photo'=>$new_filename]);
			// 	$_SESSION['success'] = 'User added successfully';

			// }
			// catch(PDOException $e){
			// 	$_SESSION['error'] = $e->getMessage();
			// }
		}

		//$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up product form first';
	}

	header('location: products.php');

?>