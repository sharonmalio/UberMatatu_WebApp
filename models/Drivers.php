<?php
	class Drivers
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $drivers = "";
		
		function __construct(){
		}

		function getDriver(){
			//pre($this->email);
			if($this->drivers != null){	
				$res = query("SELECT tbl_people.id, `fName`, `lName`, `email`,`phone_no`, `type`, `user_id`, `allocation_status` FROM `tbl_people`
			 INNER JOIN `tbl_users` ON tbl_people.user_id = tbl_users.id
				 	WHERE  tbl_people.id= ?",$this->drivers);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Drivers not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT tbl_people.id, `fName`, `lName`, `email`,`phone_no`, `type`, `user_id`, `allocation_status` FROM `tbl_people`
			 INNER JOIN `tbl_users` ON tbl_people.user_id = tbl_users.id 
			  WHERE `type` = ?", 2);
			return $res;
		}


		function get_driver($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT tbl_people.id, `fName`, `lName`, `email`,`phone_no`, `type`, `user_id`, `allocation_status` FROM `tbl_people`
			 INNER JOIN `tbl_users` ON tbl_people.user_id = tbl_users.id WHERE tbl_people.user_id = ?",$id);
			if ($res==null) {
				return array('error' => 'driver does not exist');
			}else{
				$this->drivers = $res[0]["id"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getDriver();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}


		static function searchName($drivers){
			$res = query("SELECT * FROM `tbl_drivers` WHERE `id` = ?",$drivers);
			if($res == null){
				return false;
			}
			if(isset($res[0])){
				return array('error' => 'drivers already exists');
			}
			return true;
		}
	}
?>