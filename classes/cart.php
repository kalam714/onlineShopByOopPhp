<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php


class cart{
	private $db;
	private $fm;

	
	function __construct(){
			$this->db=new Database();
	        $this->fm=new Format();
  
	}
	public function addToCart($quantity,$id){
		$quantity=$this->fm->validation($quantity);
		$quantity=mysqli_real_escape_string($this->db->link,$quantity);
		$productId=mysqli_real_escape_string($this->db->link,$id);
		$sId  =session_id();
		$squery="SELECT * FROM tbl_product WHERE productId = '$productId' ";
		$result=$this->db->select($squery)->fetch_assoc();
		$productName =$result['productName'];
		$price =$result['price'];
		$image =$result['image'];

		$chquery="SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId='$sId' ";
		$getSp=$this->db->select($chquery);
		if($getSp){
			$msg='Product already added';
			return $msg;
		} else {


			$query="INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) VALUES('$sId','$productId','$productName','$price','$quantity','$image') ";
			$pdinsert=$this->db->insert($query);
			if($pdinsert){
				  header("Location:cart.php");
			

			}else{
				 header("Location:404.php");
			}
		}
	}
	public function getCartPd(){
		$sId=session_id();
		$squery="SELECT * FROM tbl_cart WHERE sId = '$sId' ";
		$result=$this->db->select($squery);
		return $result;
	}
	public function upCart($quantity,$cartId){
		$quantity=mysqli_real_escape_string($this->db->link,$quantity);
		$cartId=mysqli_real_escape_string($this->db->link,$cartId);
		$query="UPDATE tbl_cart SET quantity='$quantity' WHERE cartId='$cartId' ";
		$update_row=$this->db->update($query);
		if($update_row){
			header("Location:cart.php");
		}else{
			$msg="Something Wrong ";
			 return $msg;
		}

	}

public function delcartPro($delcartId){
	$delcartId=mysqli_real_escape_string($this->db->link,$delcartId);
	$query="DELETE FROM tbl_cart WHERE cartId='$delcartId' ";
		$deldata=$this->db->delete($query);
		if($deldata){
		echo "<script>window.location = 'cart.php' </script>";
		}else{
			$msg="Something Wrong ";
			 return $msg;
		}
}
public function cartEmpty(){
	   $sId=session_id();
		$query="SELECT * FROM tbl_cart WHERE sId = '$sId' ";
		$result=$this->db->select($query);
		return $result;
}
public function cusCartDel(){
	$sId=session_id();
	$query="DELETE FROM tbl_cart WHERE sId='$sId' ";
	$this->db->delete($query);
}
public function insertProduct($cmrId){
	 $sId=session_id();
		$query="SELECT * FROM tbl_cart WHERE sId = '$sId' ";
		$getPro=$this->db->select($query);
		if($getPro){
			while ($result=$getPro->fetch_assoc()) {
				$productId=$result['productId'];
				$productName=$result['productName'];
				$quantity=$result['quantity'];
				$price=$result['price']*$quantity;
				$image=$result['image'];

			$query="INSERT INTO tbl_order(cmrId,productId,productName,quantity,price,image) VALUES('$cmrId','$productId','$productName','$quantity','$price','$image') ";
			$insert=$this->db->insert($query);
			}
		}
}
public function PayableAmount($cmrId){
	$query="SELECT price FROM tbl_order WHERE cmrId = '$cmrId' AND date=now() ";
		$result=$this->db->select($query);
		
}
public function getPayableOrder($cmrId){
	$query="SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY productId DESC";
		$result=$this->db->select($query);
		return $result;
}
public function OrderChk($cmrId){
	$query="SELECT * FROM tbl_order WHERE cmrId = '$cmrId'";
		$result=$this->db->select($query);
		return $result;

}
public function orderGet(){
	$query="SELECT * FROM tbl_order ORDER BY date ";
		$result=$this->db->select($query);
		return $result;

}
public function orderStUp($id,$time,$price){
	$query="UPDATE tbl_order SET status='1' WHERE cmrId='$id' AND date='$time' AND price='$price' ";
		$update_row=$this->db->update($query);
		if($update_row){
			$msg="Product Sending...";
			 return $msg;
		}else{
			$msg="Something Wrong ";
			 return $msg;
		}
}
public function orderStDl($id,$time,$price){
	$query="DELETE FROM tbl_order WHERE cmrId='$id' AND date='$time' AND price='$price' ";
		$deldata=$this->db->delete($query);
		if($deldata){
			$msg="Delete Suceesfully";
			 return $msg;
		}else{
			$msg="Something Wrong ";
			 return $msg;
		}
}
public function ConCusST($id,$time,$price){
	$query="UPDATE tbl_order SET status='2' WHERE cmrId='$id' AND date='$time' AND price='$price' ";
		$update_row=$this->db->update($query);
		if($update_row){
			$msg="Product Sending...";
			 return $msg;
		}else{
			$msg="Something Wrong ";
			 return $msg;
		}

}
}
?>