<?php include 'includes/session.php'; ?>
<?php //include 'required.php' ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
		 <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin-top: 45px; width:100%" >
	        <ol class="carousel-indicators">
	          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	          <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
	          <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
	        </ol>
	        <div class="carousel-inner">
	          <div class="item active">
	            <img src="images/banner1.png" alt="First slide">
	          </div>
	          <div class="item">
	            <img src="images/banner2.png" alt="Second slide">
	          </div>
	          <div class="item">
	            <img src="images/banner3.png" alt="Third slide">
	          </div>
	        </div>
	        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
	          <span class="fa fa-angle-left"></span>
	        </a>
	        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
	          <span class="fa fa-angle-right"></span>
	        </a>
	    </div>
	  <div class="content-wrapper" >
	    <div class="container-fluid" >
	    	
	      <!-- Main content -->
	      <section class="content" >
	        <div class="row">
	        	<div class="col-sm-12" >
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		
		          
		       		<?php //User::$auth_email; ?>
		       		<h2 class="text-center">Find Anything In <i class="fa fa-map-marker"></i> UNN, Nsukka</h2>
		       		<!-- If pagination is added to this page, then i must remove the order by random in the query -->
		       		
		       		 <?php $product = Product::fetch_all_product_with_user_details();?>
		       		 <?php //echo count($product) ?>
		       		 <?php if (count($product) > 0): ?>
		       		 <?php foreach ($product as $row): ?>
		       		 <?php $image = (!empty($row->product_image)) ? Product_Img_Path.$row->product_image : Product_NoImg_Path; ?>	
			        	<div class='col-sm-4 col-md-3'>
							<div class='box box-solid'>
								<div class='box-body prod-body'>
									<img src='<?php echo $image?>' width='100%' height='230px' class='thumbnail'>
									<h5><a href='product.php?product=<?php echo $row->slug ?>'><?php echo $row->prodname?></a></h5>
								</div>
								<div class='box-footer'>
									<b>&#8358; <?php echo number_format($row->price, 2) ; ?></b>
									<p style="float:right;">
										
											<i class="fa fa-map-marker"></i>
											<?php echo $row->address.' Nsukka' ?>
										
										
									</p>
								</div>
							</div>
						</div>
					<?php endforeach ?>
					<?php else: ?>	
						<div class="col-md-12">
							<p class="text-danger">There is no Product for Sell Currently</p>
						</div>
		       		<?php endif ?>
	        	</div>	
	        	<div class="card">
	        		<p class="text-danger text-center">You can now buy, swap or sell your item, anywhere you are in nsukka </p>
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