<?php include'lib/session.php';
Session::init();
include 'lib/database.php';
include'helpers/format.php';
spl_autoload_register(function($class){
	include_once "classes/".$class.".php";
	});
	$db=new Database();
	$fm=new Format();
	$cat=new category();
	$pd=new product();
	$ct=new cart();
	$cmr=new customer();

?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    
	<p id="demo"></p>
	<form action="alter.php">
	 <input type="text" onkeyup="loadDoc(this.value)">
	</form>
	<button type="button" onclick="loadDoc()">Search</button>

	<script>
		function loadDoc(str) {
			var xhttp =new XMLHttpRequest();
			xhttp.onreadystatechange=function(){
				if(this.readyState==4 && this.status==200){
					document.getElementById("demo").innerHTML=this.responseText;

				}

			};

			xhttp.open("GET", "alter.php?q="+str, true);
			xhttp.send();

		}
		



	</script>

			    </div>


			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
								<?php 
								$getdata=$ct->cartEmpty();
								if($getdata){
								$sum=Session::get("sum");
								$qty=Session::get("qty");
								echo "$".$sum. " Quantity:".$qty;
							}else{
								echo "Empty";
							}

								?>
							
							</span>
							</a>
						</div>
			      </div>
			      <?php 
			      if(isset($_GET['cid'])){
			      	$cmrId=Session::get("cusId");
			      	$deldata=$ct->cusCartDel();
			      	$deldata=$pd->DelCompare($cmrId);
			      	Session::destroy();
			      }


			      ?>



		   <div class="login">
		   	<?php
$login=Session::get("cuslogin");
if($login==false){ ?>
	<a href="login.php">Login</a></div>
	
<?php } else { ?>
	<a href="?cid=<?php Session::get('cusId')?>">Logout</a></div>
 <?php }



?>


		   	



		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  
	  <li><a href="topbrands.php">Top Brands</a></li>
	  <?php
	  $chkcart=$ct->cartEmpty();
	  if($chkcart){
	  	echo "<li><a href='cart.php'>Cart</a></li>";
	  	echo "<li><a href='payment.php'>Payment</a></li>";
	  } 
	  ?>
	  <?php
	  $cmrId=Session::get("cusId");
	  $chkOrder=$ct->OrderChk($cmrId);
	  if($chkOrder){
	  	echo "<li><a href='order.php'>Ordered</a></li>";
	  
	  } 
	  ?>
	  
	  <?php $login=Session::get("cuslogin");
     if($login==true){
	echo "<li><a href='profile.php'>Profile</a></li>";
}
?>
<?php 
$cmrId=Session::get("cusId");
	$getProduct=$pd->getComPd($cmrId);
if($getProduct){
?>
	 
       <li><a href="compare.php">Compare</a> </li>
   <?php } ?>
   <?php 
	$getwProduct=$pd->getwishLPd($cmrId);
if($getwProduct){
?>
	 
       <li><a href="wishlist.php">WishList</a> </li>
   <?php } ?>
	  <li><a href="contact.php">Contact</a> </li>
	  <li><a href="/shop/admin/dashbord.php">admin</a> </li>
	  <div class="clear"></div>
	</ul>
</div>