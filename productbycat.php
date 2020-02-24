<?php include 'inc/header.php';?>
<?php
		if(!isset($_GET['catid'])|| $_GET['catid']==NULL){
		  echo "<script>window.location='404.php';</script>";
		}else{
		    $id=$_GET['catid'];
		}
		?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php 
	      	$getAllpr=$pd->getPbId($id);
	      	if($getAllpr){
	      		while ($result=$getAllpr->fetch_assoc()) {


	      	?>
		


                      <div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['productId'];?>"><img height="150px" width="300px" src="admin/<?php echo $result['image'];?>" alt="" /></a>
					 <h2> <?php echo $result['productName'];  ?>  </h2>
					 <p><?php echo $fm->textShorten($result['body'],50);  ?> </p>
					 <p><span class="price">$<?php echo $result['price'];  ?> </span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>
			<?php }} else {
				echo "Product are not available in this category.";
			} ?>

			</div>

	
	
    </div>
 </div>
<?php include 'inc/footer.php';?>