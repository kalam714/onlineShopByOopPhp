<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php


class brand{
	private $db;
	private $fm;

	
	function __construct(){
			$this->db=new Database();
	        $this->fm=new Format();
  
	}
	public function brandInsert($brandName){
		$brandName=$this->fm->validation($brandName);
		$brandName=mysqli_real_escape_string($this->db->link,$brandName);
		
		if(empty($brandName)){
			 $msg="Fields Cannot Be Empty";
			 return $msg;
		}else{
			$query="INSERT INTO tbl_brand(brandName) VALUES('$brandName') ";
			$catinsert=$this->db->insert($query);
			if($catinsert){
				 $msg="Brand Inserted";
			     return $msg;
			

			}else{
				 $msg="cannot connect database";
			    return $msg;

			}
		}

	}
	public function getAllBrand(){
		$query="SELECT * FROM tbl_brand ORDER BY brandId DESC";
		$result=$this->db->select($query);
		return $result;
	}
	public function getBrandById($id){
		$query="SELECT * FROM tbl_brand WHERE brandId='$id' ";
		$result=$this->db->select($query);
		return $result;
}
public function brandUpdate($brandName,$id){
		$brandName=$this->fm->validation($brandName);
		$brandName=mysqli_real_escape_string($this->db->link,$brandName);
		$id=mysqli_real_escape_string($this->db->link,$id);
		
		if(empty($brandName)){
			 $msg="Fields Cannot Be Empty";
			 return $msg;
		}else{
		$query="UPDATE tbl_brand SET brandName='$brandName' WHERE brandId='$id' ";
		$update_row=$this->db->update($query);
		if($update_row){
			$msg="Updated Suceesfully"."<br>"."<a href='brandlist.php'>View Brand List</a>";
			 return $msg;
		}else{
			$msg="Something Wrong ";
			 return $msg;
		}

		}

	}
	public function delBrandById($id){
		$query="DELETE FROM tbl_brand WHERE brandId='$id' ";
		$deldata=$this->db->delete($query);
		if($deldata){
			$msg="Delete Suceesfully";
			 return $msg;
		}else{
			$msg="Something Wrong ";
			 return $msg;
		}
	}
	public function adminChpass($oldpass,$newpass){
		if($oldpass=="" || $newpass==""){
			$msg="fields cannot be empty";
              return $msg;
		}else{
		$query="UPDATE tbl_admin SET adminPass='$newpass' WHERE adminPass='$oldpass' ";
		$update_row=$this->db->update($query);
		if($update_row){
			$msg="Updated Suceesfully";
			 return $msg;
		}else{
			$msg="Something Wrong";
			 return $msg;
		}
	}
	}
		public function newAdminInsert($data){
		$adminName  = mysqli_real_escape_string($this->db->link,$data['adminName']);  
		$adminUser  = mysqli_real_escape_string($this->db->link,$data['adminUser']);
		$adminEmail  = mysqli_real_escape_string($this->db->link,$data['adminEmail']);
		$adminPass  = mysqli_real_escape_string($this->db->link,$data['adminPass']);
		
		
			if($adminName=="" || $adminUser=="" || $adminEmail=="" || $adminPass=""){
       	$msg="fields cannot be empty";
       	return $msg;
       }else{
       
       	$query="INSERT INTO tbl_admin(adminName,adminUser,adminEmail,adminPass) VALUES('$adminName','$adminUser','$adminEmail','$adminPass')";
			$adinsert=$this->db->insert($query);
			if($adinsert){
				  $msg="New Admin Added";
			     return $msg;
			

			}else{
				 $msg="something wrong";
			    return $msg;

			}
       }

	}
}