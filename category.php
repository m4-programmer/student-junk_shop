<?php include 'includes/session.php'; ?>
<?php
	$slug = $_GET['category'];

	$cat = Category::fetch_by_slug($slug);
	$catid = $cat['id'];
	

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper" style="margin-top:50px;">
	    <div class="container-fluid">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12">
		            <h1 class="page-header"><?php echo $cat['name']; ?>:  <span style="float:right">Total result: <b> <?php echo count(Product::fetch_product_by_category($catid)); ?></b></span></h1>
		            
		       		<?php
		       			$stmt = Product::fetch_product_by_category($catid);
		       			if (count($stmt) == 0) {
		       				echo '<p class="text-danger">There is no product at the moment</p>';
		       			}
		       			
						    	
	       						
		       		?> 
		       		
		       			<div class='row'>
	       						<?php foreach ($stmt as $row): ?>
		       			<?php 	$image = (!empty($row['product_image'])) ? Product_Img_Path.$row['product_image'] : Product_NoImg_Path; ?>
							<div class='col-sm-3'>
								<div class='box box-solid'>
   								<div class='box-body prod-body'>
   									<img src='<?php echo $image ?>' width='100%' height='230px' class='thumbnail'>
       									<h5><a href='product.php?product=<?php echo $row['slug']?>'>
       										<?php echo 	$row['name'] ?>
       									</a></h5>
       								</div>
       								<div class='box-footer'>
       									<b>&#8358; <?php echo number_format($row['price'], 2)	 ?></b>
       									<p style='float:right;'>
								
										<i class='fa fa-map-marker'> </i> <b><?php echo $row['address'] ?></b>
										 Nsukka
									
									
										</p>
       								</div>
   								</div>
   							</div>
		       			
		       		<?php endforeach ?>
	        	</div>
	        	
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>