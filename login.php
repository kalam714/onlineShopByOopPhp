<?php include 'inc/header.php';?>
<?php
$login=Session::get("cuslogin");
if($login==true){
	header("Location:order.php");
}



?>
 <?php

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){
    $cusLog=$cmr->LogCus($_POST);

}


?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
    	 	<?php
    		if(isset($cusLog)){
	        echo $cusLog;
}

    		?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post">
                	<input name="email" placeholder="Email" type="text" />
                    <input name="password" placeholder="Password" type="password" />

                    <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
                    </div>
                 </form>
                 
 <?php

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])){
    $cusReg=$cmr->insertRegInfo($_POST);

}


?>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php
    		if(isset($cusReg)){
	        echo $cusReg;
}

    		?>
    
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name"/>
							</div>
							
							<div>
							<input type="text" name="address" placeholder="Address"/>
							</div>
							
							<div>
							<input type="text" name="city" placeholder="City"/>
							</div>
							
							<div>
							<input type="text" name="country" placeholder="Country"/>
							</div>
							

		    			 </td>
		    			<td>
						<div>
							<input type="text" name="zip" placeholder="Zip-Code"/>
							</div>
							
		    		<div>
							<input type="text" name="phone" placeholder="Phone"/>
							</div>
							   
	
		           <div>
							<input type="text" name="email" placeholder="Email"/>
					</div>
							
				<div>
							<input type="text" name="password" placeholder="password"/>
							</div>
							
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php';?>