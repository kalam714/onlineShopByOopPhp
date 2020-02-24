<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php 
				$getBIphone=$pd->latestIpone();
				if($getBIphone){
			    while ($result=$getBIphone->fetch_assoc()) {
				
				?>
				
				<div class="listview_1_of_2 images_1_of_2">
			
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $result['productName'];?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php }} ?>
			   <?php 
				$getBsam=$pd->latestSamsung();
				if($getBsam){
			    while ($result=$getBsam->fetch_assoc()) {
				
				?>



				<div class="listview_1_of_2 images_1_of_2">
			
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Samsung</h2>
						<p><?php echo $result['productName'];?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
				<?php }} ?>
			</div>

		 <?php 
				$getBacer=$pd->latestAcer();
				if($getBacer){
			    while ($result=$getBacer->fetch_assoc()) {
				
				?>

              <div class="section group">

				<div class="listview_1_of_2 images_1_of_2">
			
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Acer</h2>
						<p><?php echo $result['productName'];?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
				<?php }} ?>

				 <?php 
				$getBcanon=$pd->latestCanon();
				if($getBcanon){
			    while ($result=$getBcanon->fetch_assoc()) {
				
				?>

        

				<div class="listview_1_of_2 images_1_of_2">
			
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Canon</h2>
						<p><?php echo $result['productName'];?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
				<?php }} ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	