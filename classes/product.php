<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php


class product{
	private $db;
	private $fm;

	
	function __construct(){
			$this->db=new Database();
	        $this->fm=new Format();
  
	}
	public function productInsert($data,$file){
		$productName  = mysqli_real_escape_string($this->db->link,$data['productName']);
		$catId        = mysqli_real_escape_string($this->db->link,$data['catId']);
		$brandId      = mysqli_real_escape_string($this->db->link,$data['brandId']);
		$body         = mysqli_real_escape_string($this->db->link,$data['body']);
		$price        = mysqli_real_escape_string($this->db->link,$data['price']);
		$type         = mysqli_real_escape_string($this->db->link,$data['type']);

		$permited       =array('jpg','jpeg','png','gif');
		$file_name      =$file['image']['name'];
		$file_size      =$file['image']['size'];
		$file_temp      =$file['image']['tmp_name'];

	   $div             = explode('.',$file_name);
	   $file_ext        = strtolower(end($div));
       $unique_image    = substr(md5(time()), 0, 10).'.'.$file_ext;
       $uploaded_image  = "upload/".$unique_image;
       if($productName=="" || $catId=="" || $brandId=="" || $body=="" || $price=="" || $type==""){
       	$msg="fields cannot be empty";
       	return $msg;
       }else{
       	move_uploaded_file($file_temp,$uploaded_image);
       	$query="INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type) VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type') ";
			$pdinsert=$this->db->insert($query);
			if($pdinsert){
				  $msg="Product Added"."<br>"."<a href='productlist.php'>See Product</a>";
			     return $msg;
			

			}else{
				 $msg="something wrong";
			    return $msg;

			}
       }
	


	}
	public function getAllPd(){
		$query="SELECT p.*,c.catName,b.brandName 
		FROM tbl_product as p,tbl_category as c,tbl_brand as b 
		WHERE p.catId=c.catId AND p.brandId=b.brandId 
		ORDER BY p.productId DESC";

		/*
		$query="SELECT tbl_product.*,  tbl_category.catName, tbl_brand.brandName
		FROM tbl_product
		INNER join tbl_category
		ON tbl_product.catId=tbl_category.catId 
		INNER join tbl_brand
		ON tbl_product.brandId=tbl_brand.brandId 
		ORDER BY tbl_product.productId DESC";
		*/
		$result=$this->db->select($query);
		return $result;
		
	}
	public function getProById($id){
		$query="SELECT * FROM tbl_product WHERE productId='$id' ";
		$result=$this->db->select($query);
		return $result;
	}
	public function productUpdate($data,$file,$id){
	    $productName  = mysqli_real_escape_string($this->db->link,$data['productName']);
		$catId        = mysqli_real_escape_string($this->db->link,$data['catId']);
		$brandId      = mysqli_real_escape_string($this->db->link,$data['brandId']);
		$body         = mysqli_real_escape_string($this->db->link,$data['body']);
		$price        = mysqli_real_escape_string($this->db->link,$data['price']);
		$type         = mysqli_real_escape_string($this->db->link,$data['type']);

		$permited       =array('jpg','jpeg','png','gif');
		$file_name      =$file['image']['name'];
		$file_size      =$file['image']['size'];
		$file_temp      =$file['image']['tmp_name'];

	   $div             = explode('.',$file_name);
	   $file_ext        = strtolower(end($div));
       $unique_image    = substr(md5(time()), 0, 10).'.'.$file_ext;
       $uploaded_image  = "upload/".$unique_image;
       if($productName=="" || $catId=="" || $brandId=="" || $body=="" || $price=="" || $type==""){
       	$msg="fields cannot be empty";
       	return $msg;
       }else{
       	if(!empty($file_name)){
       		move_uploaded_file($file_temp,$uploaded_image);
       		$query="UPDATE tbl_product 
       		SET 
       		productName  ='$productName',
       		catId        ='$catId',
       		brandId      ='$brandId',
       		
       		body         ='$body',
       		image        ='$uploaded_image',
       		type         ='$type'
       		WHERE productId='$id' ";

			$pdupdate=$this->db->update($query);
			if($pdupdate){
				 $msg="Product UPDATE";
			     return $msg;
			

			}else{
				 $msg="something wrong";
			    return $msg;

			}


       	}else{
       		$query="UPDATE tbl_product 
       		SET 
       		productName  ='$productName',
       		catId        ='$catId',
       		brandId      ='$brandId',
       		
       		body         ='$body',
       		type         ='$type'
       		WHERE productId ='$id' ";

			$pdupdate=$this->db->update($query);
			if($pdupdate){
				 $msg="Product UPDATE"."<br>"."<a href='productlist.php'>See Product</a>";
			     return $msg;
			

			}else{
				 $msg="something wrong";
			    return $msg;

			}


       	}
       	
       
       }
	

	}
	public function delProById($id){
		$query="SELECT * FROM tbl_product WHERE productId='$id' ";
		$getdata=$this->db->select($query);
		if($getdata){
			while ($getimg=$getdata->fetch_assoc()) {
				$dellink=$getimg['image'];
				unlink($dellink);
		}
	}
	$delquery="DELETE FROM tbl_product WHERE productId='$id' ";
	$querydel=$this->db->delete($delquery);
	if($querydel){
		$msg="Product DELETED";
		return $msg;
	}else{
		$msg="something wrong";
		return $msg;
	}
}
public function getFpro(){
	$query="SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4 ";
		$result=$this->db->select($query);
		return $result;
}
public function getNpro(){
	$query="SELECT * FROM tbl_product  ORDER BY productId DESC LIMIT 4 ";
		$result=$this->db->select($query);
		return $result;
}
public function getSingleProductById($id){
	$query="SELECT p.*,c.catName,b.brandName 
		FROM tbl_product as p,tbl_category as c,tbl_brand as b 
		WHERE p.catId=c.catId AND p.brandId=b.brandId AND p.productId='$id' ";
	

		$result=$this->db->select($query);
		return $result;

}
public function latestIpone(){
	$query="SELECT * FROM tbl_product WHERE brandId='3' ORDER BY productId DESC LIMIT 1 ";
		$result=$this->db->select($query);
		return $result;
}
public function latestAcer(){
	$query="SELECT * FROM tbl_product WHERE brandId='2' ORDER BY productId DESC LIMIT 1 ";
		$result=$this->db->select($query);
		return $result;
}
public function latestSamsung(){
	$query="SELECT * FROM tbl_product WHERE brandId='4' ORDER BY productId DESC LIMIT 1 ";
		$result=$this->db->select($query);
		return $result;
}
public function latestCanon(){
	$query="SELECT * FROM tbl_product WHERE brandId='6' ORDER BY productId DESC LIMIT 1 ";
		$result=$this->db->select($query);
		return $result;
}
public function getPbId($id){
	$query="SELECT * FROM tbl_product WHERE catId='$id' ";
		$result=$this->db->select($query);
		return $result;

}
public function insertComdata($productId,$cmrId){
	$cquery="SELECT * FROM tbl_compare WHERE cmrId='$cmrId' AND productId='$productId' ";
	$chk=$this->db->select($cquery);
	if($chk){
		$msg="Already Added to Compare List";
			return $msg;

	}

	$query="SELECT * FROM tbl_product WHERE productId='$productId' ";
	$result=$this->db->select($query)->fetch_assoc();
	if($result){
		$productId=$result['productId'];
		$productName=$result['productName'];
		$price=$result['price'];
		$image=$result['image'];
		$query="INSERT INTO tbl_compare(cmrId,productId,productName,price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
		$insertedRow=$this->db->insert($query);
		if($insertedRow){
			$msg="Data Inserted Compare Page.";
			return $msg;
		}else{
			$msg="Some thing wrong";
			return $msg;
		}
	}
	

}
public function getComPd($cmrId){
	$query="SELECT * FROM tbl_compare WHERE cmrId='$cmrId' ORDER BY id DESC ";
	$result=$this->db->select($query);
	return $result;
	
}
public function DelCompare($cmrId){
	$query="DELETE FROM tbl_compare WHERE cmrId='$cmrId' ";
	$del=$this->db->delete($query);
}
public function wlistInsert($id,$cmrId){
	$cquery="SELECT * FROM tbl_wlisit WHERE cmrId='$cmrId' AND productId='$id' ";
	$chk=$this->db->select($cquery);
	if($chk){
		$msg="Already Added to WLISIT";
			return $msg;

	}

	$query="SELECT * FROM tbl_product WHERE productId='$id' ";
	$result=$this->db->select($query)->fetch_assoc();
	if($result){
		$productId=$result['productId'];
		$productName=$result['productName'];
		$price=$result['price'];
		$image=$result['image'];
		$query="INSERT INTO tbl_wlisit(cmrId,productId,productName,price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
		$insertedRow=$this->db->insert($query);
		if($insertedRow){
			$msg="Data Inserted Wlisit.Check WLISIT Page";
			return $msg;
		}else{
			$msg="Some thing wrong";
			return $msg;
		}

}
}
public function getwishLPd($cmrId){
	$query="SELECT * FROM tbl_wlisit WHERE cmrId='$cmrId' ORDER BY id DESC ";
	$result=$this->db->select($query);
	return $result;

}
public function wlistdataDel($id,$cmrId){
	$query="DELETE FROM tbl_wlisit WHERE productId='$id' AND cmrId='$cmrId' ";
	$result=$this->db->delete($query);
	return $result;
}
public function searchPro($gText){
	$query="SELECT price,body,image,productId FROM tbl_product WHERE productName='$gText' ";
	$result=$this->db->select($query);
	return $result;
}
public function msgInsert($data){
		$name  = mysqli_real_escape_string($this->db->link,$data['name']);
		$phone      = mysqli_real_escape_string($this->db->link,$data['phone']);
		$email     = mysqli_real_escape_string($this->db->link,$data['email']);
		$subject         = mysqli_real_escape_string($this->db->link,$data['subject']);
		
       if($name=="" || $phone=="" || $email=="" || $subject==""){
       	$msg="fields cannot be empty";
       	return $msg;
       }else{
       	
       	$query="INSERT INTO tbl_contact(name,phone,email,subject) VALUES('$name','$phone','$email','$subject') ";
			$pdinsert=$this->db->insert($query);
			if($pdinsert){
				  $msg="Msg send Successfully";
			     return $msg;
			

			}else{
				 $msg="something wrong";
			    return $msg;

			}
       }
	


	}
	public function getAllMsg(){
		$query="SELECT * FROM tbl_contact";
		$result=$this->db->select($query);
		return $result;

	}
public function delMsgById($id){
	$delquery="DELETE FROM tbl_contact WHERE id = '$id' ";
	$querydel=$this->db->delete($delquery);
	
}


}
?>