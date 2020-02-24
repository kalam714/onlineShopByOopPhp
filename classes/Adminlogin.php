<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
include_once ($filepath.'/../lib/session.php');
Session::checkLogin();






?>

<?php


class Adminlogin{
	private $db;
	private $fm;

	
	function __construct(){
			$this->db=new Database();
	        $this->fm=new Format();
  
	}
	public function adminLogin($adminUser,$adminPass){
		$adminUser=$this->fm->validation($adminUser);
		$adminPass=$this->fm->validation($adminPass);
		$adminUser=mysqli_real_escape_string($this->db->link,$adminUser);
		$adminPass=mysqli_real_escape_string($this->db->link,$adminPass);
		if(empty($adminUser)|| empty($adminPass)){
			 $loginmsg="Fields Cannot Be Empty";
			 return $loginmsg;
		}else{
			$query="SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass' ";
			$result=$this->db->select($query);
			if($result !=false){
				$value=$result->fetch_assoc();
				Session::set("adminlogin",true);
				Session::set("adminid",$value['adminid']);
				Session::set("adminUser",$value['adminUser']);
				Session::set("adminName",$value['adminName']);
				header("Location:dashbord.php");

			}else{
				 $loginmsg="username or passwor does not match";
			    return $loginmsg;

			}
		}

	}
	

}

?>