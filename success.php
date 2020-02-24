<?php include 'inc/header.php' ;?>
<?php
$login=Session::get("cuslogin");
if($login==false){
	header("Location:login.php");
}
?>

<style>
	.payment{width: 500px;,min-height: 200px;text-align: center;border: 1px solid #ddd;margin: 0 auto;padding: 50px;}
	.payment h2{border-bottom: 1px solid #ddd;margin-bottom: 40px;padding-bottom: 10px;}
	.payment a{background: #ff0000 none repeat scroll 0 0;border-radius: 7px;color: #291f1f;font-size: 25px;padding: 5px,30px;}
	.payment p{text-align: left;}
	
</style>




 <div class="main">
    <div class="content">
    	
				<div class="section group">
					<div class="payment">

						<h2>Success </h2>
						<?php
					$cmrId=Session::get("cusId");
					$amount=$ct->PayableAmount($cmrId); 
					if($amount){
						$sum = 0;
						while($result=$amount->fetch_assoc()) {
							$price = $result['price'];
							$sum = $sum + $price;
						}}
					
					?>
						<p>Total Payable Amount(Including Vat) : $
							<?php $vat =$sum * .01;
							echo $total=$sum + $vat;
							echo $price;

							?>
						
						</p>
						<p>Thank You For Chosse Our Site.Our Team Contact You As Soon As Possiable.View 
							Your <a href="order.php">Order Details</a></p>
					

						
						
					</div>
					


					</div>
				</div>
			    
    	</div>  	
       <div class="clear"></div>
    
 
<?php include 'inc/footer.php';?>