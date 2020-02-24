<?php include 'inc/header.php' ;?>
<?php 
if(isset($_GET['delpro'])){
	$delcartId=$_GET['delpro'];
	$delpro=$ct->delcartPro($delcartId);

}

?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$cartId=$_POST['cartId'];
    $quantity=$_POST['quantity'];
    $updateCart=$ct->upCart($quantity,$cartId);
    if($quantity <=0){
    	$delpro=$ct->delcartPro($cartId);
    }

}



?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php
			    	if(isset($updateCart)){
			    		echo $updateCart;
			    	}
			    	if(isset($delpro)){
			    		echo $delpro;
			    	}
			    	?>
						<table class="tblone">
							<tr><th width="10%">SL</th>
								<th width="20%">Product Name</th>
								<th width="15%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php 
							$getProduct=$ct->getCartPd();
							if($getProduct){
								$i=0;
							 	$sum=0;
							 	$qty=0;
								while ($result=$getProduct->fetch_assoc()) {
									$i++;
								
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'];?> </td>
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td>$<?php echo $result['price'];?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'];?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity'];?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>$<?php
								$total= $result['price'] * $result['quantity'];
								echo $total;?></td>
								<td><a onclick="return confirm('Are You Sure To Delete?')" href="?delpro=<?php  echo $result['cartId']; ?>">X</a></td>
							</tr>
							<?php 
							$qty=$qty+$result['quantity'];
							$sum=$sum+$total; 
							Session::set("sum",$sum);
							Session::set("qty",$qty);
							?>
							<?php }} ?>
							
							
						</table>
						<?php
						$getdata=$ct->cartEmpty();
								if($getdata){
									?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$<?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>$ .01</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$<?php 
								$gtotal=$sum*.01+$sum;
								echo $gtotal;
								?> </td>
							</tr>
					   </table>
					<?php } else{
						header("Location:index.php");
					}?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php';?>