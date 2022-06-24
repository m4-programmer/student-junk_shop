<?php 
session_start();
require 'classes/Db.php';
require 'classes/Admin.php';
require 'classes/User.php';
require 'classes/Product.php';
require 'classes/Category.php';
require 'classes/Cart.php';
require 'const.php';

$admin = new Admin;
$user = new User;
$product = new Product;
$category = new Category;
 ?>