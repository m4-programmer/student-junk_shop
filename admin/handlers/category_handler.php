<?php 
	include '../includes/session.php';
	include '../includes/slugify.php';

	

	/* This Section Feed's the  Ajax request in category.php under < function getRow(id) > */
	if (isset($_GET['edit'])) {
		if(isset($_POST['id'])){
		$id = $_POST['id'];
		$row = Category::fetch_category($id);
		echo json_encode($row);
		}
	}

	/*This Section handles adding of new Categories*/
	if (isset($_GET['add'])) {
		if(isset($_POST['add'])){
		$name = $_POST['name'];

		if (Category::is_unique($name) == true) {
			$_SESSION['error'] = 'Category already exist';
		}
		else{
			$cat_slug = slugify($name);
			$add = Category::create($name,$cat_slug);
			if ($add == true) {
				$_SESSION['success'] = 'Category added successfully';
			}else{
				$_SESSION['error'] = 'Category Could not be added, Try again later';
			}	
		}
	}
	else{
		$_SESSION['error'] = 'Fill up category form first';
	}

	header('location: '.Url_Admin.'category.php');

	}


	/*This Section handles Deleting a Category*/
	if (isset($_GET['delete'])) {
		if(isset($_POST['delete'])){
		$id = $_POST['id'];
		
		Category::delete($id);
		$_SESSION['success'] = 'Category deleted successfully';
	}
	else{
		$_SESSION['error'] = 'Select category to delete first';
	}

	header('location: '.Url_Admin.'category.php');
	}

	/*This Section handles updating Categories Entries*/
	if (isset($_GET['update'])) {
		if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$cat_slug = slugify($name);
		
		Category::update($name,$cat_slug,$id);
		$_SESSION['success'] = 'Category updated successfully';
		
	}
	else{
		$_SESSION['error'] = 'Fill up edit category form first';
	}

	header('location: '.Url_Admin.'category.php');
	}
 ?>