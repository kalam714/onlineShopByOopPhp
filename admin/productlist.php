<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>
<?include      '../helpers/format.php';?>

<?php 
$pd=new product();
$fm=new Format();
if(isset($_GET['delpro'])){
	$id=$_GET['delpro'];
	$delPro=$pd->delProById($id);
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
					<th>ProductName</th>
					<th>CatId</th>
					<th>BrandId</th>
					<th>Body</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
						$getpd =$pd->getAllPd();
						if($getpd){
							$i=0;
							while ($result=$getpd->fetch_assoc()) {
								$i++;
							



						?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName'];?></td>
					<td><?php echo $result['catName'];?></td>
					<td><?php echo $result['brandName'];?></td>
					<td><?php echo $fm->textShorten($result['body'],50);?></td>
					
					
					<td>$<?php echo $result['price'];?></td>
					<td><img src="<?php echo $result['image'];?>" height="40px" width="60px"/></td>
					<td>
						<?php
						if($result['type']==0){
							echo "Featured";
						}else{
							echo "General";
						}

						?>
						
					</td>
					<td><a href="editproduct.php?proid=<?php echo $result['productId'];?> ">Edit</a> || <a onclick="return confirm('Are You Sure To Delete?')" href="?delpro=<?php echo $result['productId'];?>">Delete</a></td>
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
