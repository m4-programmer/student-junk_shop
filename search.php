<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper" style="margin-top:40px">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12">

	            <?php
	       			$admin->query("SELECT *, products.name AS prodname, products.photo as product_image ,category.name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id left JOIN users on products.seller_id = users.id WHERE products.name LIKE :keyword or address LIKE :address or price LIKE :price");
	       			$admin->bind(':keyword','%'.$_POST['keyword'].'%');
	       			$admin->bind(':address','%'.$_POST['keyword'].'%');
	       			$admin->bind(':price','%'.$_POST['keyword'].'%');
	       			$stmt = $admin->fetchresult();
	       			$counted = count($stmt);
	       			
	       			if(count($stmt) < 1){
	       				echo '<h1 class="page-header">No results found for <i>'.$_POST['keyword'].'</i></h1>';
	       			}
	       			else{
	       				echo '<h1 class="page-header">Search results for <i>'.$_POST['keyword'].'</i>
	       				<span style="float:right">Total result: '.$counted.'</span>
	       				</h1>';
	       				
	       				echo "<div class='row'>";
	       				foreach ($stmt as $row) {
						    	$highlighted = preg_filter('/' . preg_quote($_POST['keyword'], '/') . '/i', '<b>$0</b>', $row['prodname']);
						    	$color = '';
						    	$price = '';
						    	if(is_numeric($_POST['keyword'])){
						    		$highlighted = $row['prodname'];
						    		$price = 'blue';
						    	}
						    	else if (!$highlighted ) {
						    		$highlighted = $row['prodname'];
						    		$color = 'blue';
						    	}else{
						    		
						    	}
						    	$image = (!empty($row['product_image'])) ? 'images/products/'.$row['product_image'] : 'images/noimage.jpg';
						    	
	       						
	       						echo "
	       							<div class='col-sm-3'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$highlighted."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#8358; <span style=color:$price >".number_format($row['price'], 2)."</span></b>
		       									<p style='float:right;'>
								
												<i class='fa fa-map-marker'> </i> <b style=color:$color>". $row['address']." </b>
												 Nsukka
												</p>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						 
						    }
		   				echo "</div>";
					}

					

	       		?> 
	        	</div>
	        	<?php echo preg_filter('/' . preg_quote($_POST['keyword'], '/') . '/i', '<b>$0</b>', 'trafancy') ?>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>