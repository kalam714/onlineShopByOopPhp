<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/customer.php');

?>
<?php
if(!isset($_GET['cusId'])|| $_GET['cusId']==NULL){
  echo "<script>window.location='catlist.php';</script>";
}else{
    $id=$_GET['cusId'];
}

if($_SERVER['REQUEST_METHOD']=='POST'){
  echo "<script>window.location='inbox.php';</script>";
}



?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                

              
                <?php
                $cmr=new customer();

                $getCusData=$cmr->CusData($id);
                if($getCusData){
                    while($result=$getCusData->fetch_assoc()){


                


                ?>




                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text"   value="<?php  echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>
                           <tr>
                            <td>
                                <input type="text"  value="<?php  echo $result['address'];?>" class="medium" />
                            </td>
                        </tr>
                           <tr>
                            <td>
                                <input type="text" value="<?php  echo $result['city'];?>" class="medium" />
                            </td>
                        </tr>
                           <tr>
                            <td>
                                <input type="text"  value="<?php  echo $result['country'];?>" class="medium" />
                            </td>
                        </tr>
                           <tr>
                            <td>
                                <input type="text"  value="<?php  echo $result['phone'];?>" class="medium" />
                            </td>
                        </tr>
                           <tr>
                            <td>
                                <input type="text"  value="<?php  echo $result['email'];?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>