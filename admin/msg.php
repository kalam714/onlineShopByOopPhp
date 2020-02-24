<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>
<?include      '../helpers/format.php';?>

<?php 
$pd=new product();
$fm=new Format();
if(isset($_GET['delmsg'])){
	$id=$_GET['delmsg'];
	$delMSg=$pd->delMsgById($id);
}         




?>




<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Massege</th>
					
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
						$getMsg =$pd->getAllMsg();
						if($getMsg){
							$i=0;
							while ($result=$getMsg->fetch_assoc()) {
								$i++;
							



						?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name'];?></td>
					<td><?php echo $result['phone'];?></td>
					<td><?php echo $result['email'];?></td>
					
					
					
					<td><?php echo $result['subject'];?></td>
				
					
					<td> <a onclick="return confirm('Are You Sure To Delete?')" href="?delmsg=<?php echo $result['id'];?>">Remove</a></td>
				</tr>
				<?php } }?>
				
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
