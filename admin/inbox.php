<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/cart.php');
$ct=new cart();
$fm=new format();

?>
<?php 
if(isset($_GET['Shifted'])){
$id=$_GET['Shifted'];
$time=$_GET['date'];
$price=$_GET['price'];
$upOrderSt=$ct->orderStUp($id,$time,$price);
}
if(isset($_GET['delCus'])){
$id=$_GET['delCus'];
$time=$_GET['date'];
$price=$_GET['price'];
$upOrderDl=$ct->orderStDl($id,$time,$price);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php if(isset($upOrderSt)){
                	echo $upOrderSt;
                } ?>
                  <?php if(isset($upOrderDl)){
                	echo $upOrderDl;
                } ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Date & Time</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Cus ID</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						
						$getOrder = $ct->orderGet();
						if($getOrder){
							while ($result=$getOrder->fetch_assoc()) {
						
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $result['id'];?></td>
							<td><?php echo $fm->formatDate($result['date']);?></td>
							<td><?php echo $result['quantity'];?></td>
							<td><?php echo $result['price'];?></td>
							<td><?php echo $result['cmrId'];?></td>
							<td><a href="customer.php?cusId=<?php echo $result['cmrId'];?>">View Details</a></td>
							<?php if( $result['status']=='0'){ ?>
                            <td><a href="?Shifted=<?php echo $result['cmrId'];?> &price=<?php echo $result['price'];?>&date=<?php echo $result['date'];?>">Shifted</a></td>
                            <?php } elseif($result['status']=='1') { ?>
                            	<td>Pending</td>
                            <?php } else { ?>
                            	<td><a href="?delCus=<?php echo $result['cmrId'];?> &price=<?php echo $result['price'];?>&date=<?php echo $result['date'];?>">Remove</a></td>
                            
                           <?php }
							?>
							
						</tr>
						<?php }} ?>
					</tbody>
				
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
