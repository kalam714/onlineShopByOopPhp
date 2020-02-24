<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php


class customer{
	private $db;
	private $fm;

	
	function __construct(){
			$this->db=new Database();
	        $this->fm=new Format();
  
	}
	public function insertRegInfo($data){
		$name = mysqli_real_escape_string($this->db->link,$data['name']);
		$address      = mysqli_real_escape_string($this->db->link,$data['address']);
		$city      = mysqli_real_escape_string($this->db->link,$data['city']);
		$country         = mysqli_real_escape_string($this->db->link,$data['country']);
		$zip        = mysqli_real_escape_string($this->db->link,$data['zip']);
		$phone         = mysqli_real_escape_string($this->db->link,$data['phone']);
		$email = mysqli_real_escape_string($this->db->link,$data['email']);
		$password = mysqli_real_escape_string($this->db->link,md5($data['password']));
		if($name=="" || $address=="" || $city=="" || $country=="" || $zip=="" || $phone=="" || $email=="" || $password==""){
       	$msg="fields cannot be empty";
       	return $msg;
	}
	$mailquery="SELECT * FROM tbl_customer WHERE email ='$email'";
	$mailchk=$this->db->select($mailquery);
	if($mailchk !=false){
		$msg="Email alrady Exists.";
       	return $msg;
	}else{
		$query="INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,password) VALUES('$name','$address','$city','$country','$zip','$phone','$email','$password') ";
			$csinsert=$this->db->insert($query);
			if($csinsert){
				  $msg="Regitration Suceesfully Done";
			     return $msg;
			

			}else{
				 $msg="something wrong";
			    return $msg;

			}
       }
	
   }
public function LogCus($data){
	    $email = mysqli_real_escape_string($this->db->link,$data['email']);
		$password = mysqli_real_escape_string($this->db->link,md5($data['password']));
		if(empty($email) || empty($password)){
			$msg="fields cannot be empty";
       	   return $msg;

		}

		$query="SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' ";
		$result=$this->db->select($query);
		if($result !=false){
		$value=$result->fetch_assoc();
		Session::set("cuslogin",true);
		Session::set("cusId",$value['id']);
		Session::set("cusName",$value['name']);
		header("Location:cart.php");

}else{
	echo "Email Or Password Does Not MAtch.Try Again.";
}

}
public function CusData($id){
	
		$query="SELECT * FROM tbl_customer WHERE id = '$id' ";
		$result=$this->db->select($query);
		return $result;
}
public function ProfileUp($data,$cusid){
	   $name = mysqli_real_escape_string($this->db->link,$data['name']);
		$address      = mysqli_real_escape_string($this->db->link,$data['address']);
		$city      = mysqli_real_escape_string($this->db->link,$data['city']);
		$country         = mysqli_real_escape_string($this->db->link,$data['country']);
		$zip        = mysqli_real_escape_string($this->db->link,$data['zip']);
		$phone         = mysqli_real_escape_string($this->db->link,$data['phone']);
		$email = mysqli_real_escape_string($this->db->link,$data['email']);
		
		if($name=="" || $address=="" || $city=="" || $country=="" || $zip=="" || $phone=="" || $email=="" ){
       	$msg="fields cannot be empty";
       	return $msg;
	}else{
		$query="UPDATE tbl_customer SET 
		name='$name',
		address='$address',
		city='$city',
		country='$country',
		zip='$zip',
		phone='$phone',
		email='$email'
		 WHERE id='$cusid' ";
		$update_row=$this->db->update($query);
		if($update_row){
			$msg="Updated Suceesfully";
			 return $msg;
		}else{
			$msg="Something Wrong ";
			 return $msg;
		}
	}

}
}
?>