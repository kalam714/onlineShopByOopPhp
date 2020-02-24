<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php


class category{
	private $db;
	private $fm;

	
	function __construct(){
			$this->db=new Database();
	        $this->fm=new Format();
  
	}
	public function catInsert($catName){
		$catName=$this->fm->validation($catName);
		$catName=mysqli_real_escape_string($this->db->link,$catName);
		
		if(empty($catName)){
			 $msg="Fields Cannot Be Empty";
			 return $msg;
		}else{
			$query="INSERT INTO tbl_category(catName) VALUES('$catName') ";
			$catinsert=$this->db->insert($query);
			if($catinsert){
				 $msg="Category Inserted";
			     return $msg;
			

			}else{
				 $msg="cannot connect database";
			    return $msg;

			}
		}

	}
	public function getAllCat(){
		$query="SELECT * FROM tbl_category ORDER BY catId DESC";
		$result=$this->db->select($query);
		return $result;
	}
	public function getCatById($id){
		$query="SELECT * FROM tbl_category WHERE catId='$id' ";
		$result=$this->db->select($query);
		return $result;

	}
	public function catUpdate($catName,$id){
		$catName=$this->fm->validation($catName);
		$catName=mysqli_real_escape_string($this->db->link,$catName);
		$id=mysqli_real_escape_string($this->db->link,$id);
		
		if(empty($catName)){
			 $msg="Fields Cannot Be Empty";
			 return $msg;
		}else{
		$query="UPDATE tbl_category SET catName='$catName' WHERE catId='$id' ";
		$update_row=$this->db->update($query);
		if($update_row){
			$msg="Updated Suceesfully"."<br>"."<a href='catlist.php'>View Category</a>";
			 return $msg;
		}else{
			$msg="Something Wrong ";
			 return $msg;
		}

		}

	}
	public function delCatById($id){
		$query="DELETE FROM tbl_category WHERE catId='$id' ";
		$deldata=$this->db->delete($query);
		if($deldata){
			$msg="Delete Suceesfully";
			 return $msg;
		}else{
			$msg="Something Wrong ";
			 return $msg;
		}
	}

}

?>