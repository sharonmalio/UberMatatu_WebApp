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
				$res = query("SELECT `id`,`start_mileage`,`end_mileage`,`date`,`vehicle_driver`,`start_time`,`stop_time`,`driver_creator`,`start_coordinate`,`end_coordinate`
					FROM `tbl_drivers`
				 	WHERE  `id`= ?",$this->drivers);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Drivers not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT `id`, `fName`, `lName`, `phone_no`, `type`, `user_id`, `allocation_status` FROM `tbl_people` WHERE `type` = ?", 2);
			return $res;
		}

		// function add_driver($driver_creator,$start_coordinate,$end_coordinate){

		// 	//pre($profile);
		// 	/*if($this->searchName($drivers)){
		// 		return array('error' => 'drivers already exists');
		// 	}else{*/
		// 			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
		// 			$res = query("INSERT INTO `tbl_drivers` (`driver_creator`,`start_coordinate`,`end_coordinate`) 
		// 				VALUES (?,?,?)",$driver_creator,$start_coordinate,$end_coordinate);
		// 			// $this->drivers = $drivers;				
		// 			//regenerate token expiry key
		// 			/*$token = new Token();
		// 			$t = $token->generateToken($this->uid,$api_access);*/
		// 			return $this->getDriver();
		// 		}
		// 		//TODO: add profile and handle null values
		// 		//return array('error' => 'invalid email or password');
		// // }

		function get_driver($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`, `fName`, `lName`, `phone_no`, `type`, `user_id`, `allocation_status` FROM `tbl_people` WHERE `id` = ?",$id);
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

		// function update_drivers($id,$drivers,$make_id){
		// 	//return $id;
		// 	//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
		// 	$res = query("SELECT `id`,`drivers`,`make_id` FROM `tbl_vehicle_drivers` WHERE `id` = ?",$id);
		// 	if ($res==null) {
		// 		return array('error' => 'drivers does not exist');
		// 	}else{
		// 		$this->drivers = $res[0]["drivers"];
		// 		$res=query("UPDATE `tbl_vehicle_drivers` SET `drivers`=?,`make_id`=? WHERE `id`=?",
		// 			$drivers,$make_id,$id);
		// 		/*//regenerate token expiry key
		// 		$token = new Token();
		// 		$t = $token->generateToken($this->uid,$api_access);*/
		// 		return array($this->getDriver());
		// 		//TODO: add profile and handle null values
		// 		//return array('error' => 'invalid email or password');
		// 	}
		// }

		// function delete_driver($id){
		// 	//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
		// 	$res = query("SELECT `id`,`start_mileage`,`end_mileage`,`date`,`vehicle_driver`,`start_time`,`stop_time`,`driver_creator`,`start_coordinate`,`end_coordinate` FROM `tbl_drivers` WHERE `id`=?",
		// 		$id);
		// 	if ($res==null) {
		// 		return array('error' => 'drivers does not exist');
		// 	}else{
		// 		$this->id = $res[0]["id"];
		// 		query("DELETE FROM `tbl_drivers` WHERE `id`=?",
		// 			$id);
		// 		/*//regenerate token expiry key
		// 		$token = new Token();
		// 		$t = $token->generateToken($this->uid,$api_access);*/
		// 		return array('drivers' => $res[0]);
		// 		//TODO: add profile and handle null values
		// 		//return array('error' => 'invalid email or password');
		// 	}
		// }


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