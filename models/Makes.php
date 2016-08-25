<?php
	class Makes
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $make = "";
		
		function __construct(){
		}

		function getMake(){
			//pre($this->email);
			if($this->make != null){	
				$res = query("SELECT `id`,`make`
					FROM `tbl_vehicle_make`
				 	WHERE  `make`= ?",$this->make);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Make not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT `id`,`make`
					FROM `tbl_vehicle_make`");
			return $res;
		}

		function add_make($make){
			//pre($profile);
			if($this->searchName($make)){
				return array('error' => 'make already exists');
			}else{
					//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
					$res = query("INSERT INTO `tbl_vehicle_make` (`make`) 
						VALUES (?)",$make);
					$this->make = $make;				
					//regenerate token expiry key
					/*$token = new Token();
					$t = $token->generateToken($this->uid,$api_access);*/
					return $this->getMake();
				}
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
		}

		function get_make($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`make` FROM `tbl_vehicle_make` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'make does not exist');
			}else{
				$this->make = $res[0]["make"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getMake();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		// function self_update_make($name, $name, $description, $company_id){
		// 	$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
		// 	$res = query("SELECT `id`,`name`,`description`,`company_id` FROM `tbl_vehicle_make` WHERE `id`=?",
		// 		$name);
		// 	if ($res==null) {
		// 		return array('error' => 'make does not exist');
		// 	}else{
		// 		return $type;
		// 		$this->name = $res[0]["name"];
		// 		query("UPDATE `tbl_vehicle_make` SET `name`=?,`description`=?,`company_id`=?,`type`=? WHERE `id`=?",
		// 			$name, $description, $company_id, $type,$name);
		// 		regenerate token expiry key
		// 		$token = new Token();
		// 		$t = $token->generateToken($this->uid,$api_access);
		// 		return array($this->getMake());
		// 		TODO: add profile and handle null values
		// 		return array('error' => 'invalid email or password');
		// 	}
		// }

		function update_make($id,$make){
			//return $id;
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`make`FROM `tbl_vehicle_make` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'make does not exist');
			}else{
				$this->make = $res[0]["make"];
				$res=query("UPDATE `tbl_vehicle_make` SET `make`=? WHERE `id`=?",
					$make,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getMake());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function delete_make($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`make` FROM `tbl_vehicle_make` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'make does not exist');
			}else{
				$this->make = $res[0]["make"];
				query("DELETE FROM `tbl_vehicle_make` WHERE `id`=?",
					$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array('make' => $res[0]);
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}


		static function searchName($make){
			$res = query("SELECT * FROM `tbl_vehicle_make` WHERE `make` = ?",$make);
			if($res == null){
				return false;
			}
			if(isset($res[0])){
				return array('error' => 'make already exists');
			}
			return true;
		}
	}
?>