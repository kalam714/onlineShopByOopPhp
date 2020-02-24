<?php 
include 'lib/database.php';
include'helpers/format.php';
include 'classes/product.php';
$pd=new product();
$fm=new Format();
?>

 <table class="data display datatable" id="example">
			<thead>
				<tr>
				
					<th>Body</th>
					<th>Price</th>
					<th>Image</th>
					<th>View</th>
					
				</tr>
			</thead>
			<tbody>
				<?php

				$gText=$_REQUEST['q'];
				$getpd =$pd->searchPro($gText);
						if($getpd){
							
							while ($result=$getpd->fetch_assoc()) {
								
							



						?>
				<tr class="odd gradeX">
					
				
					
					<td><?php echo $fm->textShorten($result['body'],50);?></td>
					
					
					<td>$<?php echo $result['price'];?></td>
					<td style="height: 50px;width: 70px;"><img  src="admin/<?php echo $result['image'];?>" alt=""/></td>
					<td><a href="details.php?proid=<?php echo $result['productId'];?>">View</a></td>
				</tr>
				<?php } } else{
					echo"Search dosenot match";
				}?>
				
			</tbody>
		</table>