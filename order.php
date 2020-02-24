<?php include 'inc/header.php' ;?>
<?php
$login=Session::get("cuslogin");
if($login==false){
	header("Location:login.php");
}
if(isset($_GET['cusCon'])){
$id=$_GET['cusCon'];
$time=$_GET['date'];
$price=$_GET['price'];
$cusConSt=$ct->ConCusST($id,$time,$price);
}



?>




 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
				<div class="section group">
					<div class="notfound">
                   <h3>Your Order Details</h3>
                   <table class="tblone">
							<tr><th>SL</th>
								<th>Product Name</th>
								<th>Image</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Date</th>
								<th>status</th>
								<th>Action</th>
							</tr>
							<?php 
							$cmrId=Session::get("cusId");
							$getOrder=$ct->getPayableOrder($cmrId);
							if($getOrder){
								$i=0;
							 	
								while ($result=$getOrder->fetch_assoc()) {
									$i++;
								
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'];?> </td>
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td><?php echo $result['quantity'];?></td>
							
								<td>$<?php echo $result['price'];?></td>
								<td><?php echo $fm->formatDate($result['date']);?> </td>
								<td><?php
									if($result['status']=='0'){
										echo "Pending";
									}elseif($result['status']=='1'){
									echo "Shifted";
									 }
									else{
										echo "OK";
									}
									?>	
									</td>
									<?php 
									if($result['status']=='1'){ ?>
                                   <td><a href="?cusCon=<?php echo $cmrId;?> &price=<?php echo $result['price'];?>&date=<?php echo $result['date'];?>">Confirm</a></td>
							       </tr>
									<?php }elseif($result['status']=='2'){?>
										<td>OK</td>
									<?php } elseif ($result['status']=='0'){?>
										<td>OK</td>
									<?php }
									?>
							
							

							<?php }} ?>
							
							
						</table>



					</div>
				</div>
			    
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php';?>