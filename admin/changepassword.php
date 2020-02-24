<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include'../classes/brand.php';?>
<?php
$al=new brand();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
    $oldpass=md5($_POST['oldpass']);
    $newpass=md5($_POST['newpass']);
    $loginChpass=$al->adminChpass($oldpass,$newpass);

}
?>
<div class="grid_10">
    <div class="box round first grid">
        <?php if(isset($loginChpass)){
            echo $loginChpass;
        }?>
        <h2>Change Password</h2>
        <div class="block">               
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="oldpass" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="newpass" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>

        </div>
        <h2>Add New ADMIN</h2>

        <?php
$al=new brand();
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['sub'])){
   
    $insertAd=$al->newAdminInsert($_POST);

}
?>

        <div class="block">               
         <form action="" method="post">
            <table class="form">   
             <?php if(isset($insertAd)){
            echo $insertAd;
        }?>                 
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter name..."  name="adminName" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Username..."  name="adminUser" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Email..."  name="adminEmail" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter password..."  name="adminPass" class="medium" />
                    </td>
                </tr>
                 
                
                 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="sub" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
            
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>