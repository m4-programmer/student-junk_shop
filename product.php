<?php include 'includes/session.php'; ?>
<?php
	$conn = $pdo->open();

	$slug = $_GET['product'];
	
	$product = Product::fetch_all_product_with_user_details($slug);

	//page view counter
	$now = date('Y-m-d');
    
    if($product->date_view == $now){

         $admin->query("UPDATE products SET counter=:counter WHERE id=:id");
         $admin->bind(':counter',$product->counter + 1);
         $admin->bind(':id',$product->prodid);
         $admin->execute();
        
    }

    if($product->date_view != $now){
        
        $admin->query("UPDATE products SET counter=1, date_view=:now WHERE id=:id");
        $admin->bind(':id',$product->prodid);
        $admin->bind(':now',$now);
        $admin->execute();
    }
	
	

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">

<div class="wrapper" >

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper" style="margin-top:50px; width: 100%;">
	    <div class="container-fluid">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<div class="callout" id="callout" style="display:none">
	        			<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
	        			<span class="message"></span>
	        		</div>
		            <div class="row">
		            	<div class="col-sm-6">
		            		<img src="<?php echo (!empty($product->product_image)) ? Product_Img_Path.$product->product_image :  Product_NoImg_Path; ?>" width="100%" class="zoom" data-magnify-src="images/large-<?php echo $product->product_image; ?>">
		            		<br><br>
		            		
		            	</div>
		            	<div class="col-sm-6">
		            		<h1 class="page-header"><b><u><?php echo $product->prodname; ?></u></b></h1>
		            		<h3><b>&#8358; <?php echo number_format($product->price, 2); ?></b></h3>
		            		<p><b>Category:</b> <a href="category.php?category=<?php echo $product->cat_slug; ?>"><?php echo $product->catname; ?></a></p>
		            		<p><b>Seller Location:</b> <?php echo $product->address.' Nsukka, Enugu Nigeria'; ?></p>
		            		<p><b>Seller Name:</b> <i><?php echo $product->firstname.' '.$product->lastname; ?></i></p>
		            		<p><b>Description:</b></p>
		            		<p><?php echo $product->description; ?></p>
		            	</div>
		            </div>
		            <br>
				    <div class="fb-comments" data-href="http://localhost/ecommerce/product.php?product=<?php echo $slug; ?>" data-numposts="10" width="100%"></div> 
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	        <div class="row">
	        	<div class="col-md-8">
	        		<form class="form-inline" id="productForm">
		            			<div class="form-group">
			            			<div class="input-group col-sm-5" style="display: none;">
			            				
			            				<span class="input-group-btn">
			            					<button type="button" id="minus" class="btn btn-default btn-flat btn-lg"><i class="fa fa-minus"></i></button>
			            				</span>
							          	<input type="text" name="quantity" id="quantity" class="form-control input-lg" value="1">
							            <span class="input-group-btn">
							                <button type="button" id="add" class="btn btn-default btn-flat btn-lg"><i class="fa fa-plus"></i>
							                </button>
							            </span>
							            <input type="hidden" value="<?php echo $product->prodid; ?>" name="id" id='id'>
							            
							        </div>
							        <!-- <div class="alert alert-danger" id="response" style="display:none">
					        			<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
					        			<span id="result"></span>
					        		</div> -->
					        		<!-- Begining of Response -->
							        <span id="result"></span>
									<!-- End of Response -->
									<!-- Begining of Buttons -->
					        		<a  id="showcontact"  class="btn btn-lg btn-success"><i class="fa fa-phone"></i> Show Contact</a>
					        		<!-- Start Chat will Take you to the seller Whatsapp account -->
					        		<a id="chat"  class="btn btn-lg btn-primary"><i class="fa fa-envelope"></i> Start Chat</a> 
			            			<button type="submit" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
			            			<!-- End of Buttons -->
			            		</div>
		            		</form>
	        	</div>
	        </div>
	        <!-- Other Recommendations -->
	        <!-- Main content -->
	      <section class="container-fluid " >
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
	        	</div>	
		          
		       		<?php //User::$auth_email; ?>
		       		<h2 class="text-center">Check Out Other Product In <i class="fa fa-map-marker"></i> UNN, Nsukka</h2>
		       		
		       		 <?php $product = Product::FetchProductRandomly($slug);?>
		       		 

		       		 <?php if (count($product) > 0): ?>
		       		 <?php foreach ($product as $row): ?>
		       		 	
		       		 <?php $image = (!empty($row->product_image)) ? Product_Img_Path.$row->product_image : Product_NoImg_Path; ?>	
			        	<div class='col-sm-6 col-md-3' >
							<div class='box box-solid' >
								<div class='box-body prod-body'>
									<img src='<?php echo $image?>' width='100%' height='230px' class='thumbnail'>
									<h5><a href='product.php?product=<?php  echo $row->slug ?>'><?php echo $row->prodname?></a></h5>
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

	        	
	        	<div class="card">
	        		<p class="text-danger text-center">You can now buy, swap or sell your item, anywhere you are in nsukka </p>
	        	</div>
	        </div>
	      </section>
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	// $('.alert').alert()
	// $('#add').click(function(e){
	// 	e.preventDefault();
	// 	var quantity = $('#quantity').val();
	// 	quantity++;
	// 	$('#quantity').val(quantity);
	// });
	// $('#minus').click(function(e){
	// 	e.preventDefault();
	// 	var quantity = $('#quantity').val();
	// 	if(quantity > 1){
	// 		quantity--;
	// 	}
	// 	$('#quantity').val(quantity);
	// });
	// Show Seller Contact
	$('#showcontact').click(function () {
		//get the product id visitor wishes to get phone number and chat with
		var productid = $('#id').val();
		//alert(productid)
		var data = getPhoneNumber(productid);
		
	});
function Chat(id){
	 $.ajax({
	    type: 'POST',
	    url: 'ajax_handler/get_details.php',
	    data: {id:id},
	    dataType: 'json',
	    success: function(response){
	    	//if response.message is authenticated then show visitor seller's information
	    	if (response.msg == 0) {
	    		result =  'Please You need to Login First!!';
	    		
				$('#result').html('<div class="alert alert-danger alert-dismissible " id="response"  role="alert"><strong>Error Msg:</strong> <span id="value">'+result+'</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>')
				
	    		
		    }else{
		    	
		    	if (response.whatsapp == null) {
		    		message = 'Seller has not uploaded their whatsapp address yet, please try calling the seller';
		    		$('#result').html('<div class="alert alert-warning alert-dismissible " id="response"  role="alert"><strong>Error Msg:</strong> <span id="value">'+message+'</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>')
		    	}else{
		    	window.open(response.whatsapp)
		    	}
		    }
	      },    
	  });		   
}
	$('#chat').click(function () {
		//get the product id visitor wishes to get phone number and chat with
		var productid = $('#id').val();
		//alert(productid)
		Chat(productid);	
	});

	function getPhoneNumber(id){
	  $.ajax({
	    type: 'POST',
	    url: 'ajax_handler/get_details.php',
	    data: {id:id},
	    dataType: 'json',
	    success: function(response){
	    	//if response.message is authenticated then show visitor seller's information
	    	if (response.msg == 0) {
	    		result =  'Please You need to Login First!!';
	    		
				$('#result').html('<div class="alert alert-danger alert-dismissible " id="response"  role="alert"><strong>Error Msg:</strong> <span id="value">'+result+'</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>')
	    		
		    }else{
		    	var success = "<i class=\"fa fa-phone\"></i> "+ response.number;
		    	// Set's the contact attributes
		    	$('#showcontact').attr('href', 'tel:'+response.number)
		    	$('#showcontact').html(success)
		    }
	      },    
	  });		   
}



});
</script>
</body>
</html>