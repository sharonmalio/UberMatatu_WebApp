<?php
	class Vehicles
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $plate = "";
		
		function __construct(){
		}

		function getVehicle(){
			//pre($this->email);
			if(!$this->plate == null){	
				$res = query("SELECT tbl_vehicles.id,`plate`, `make`,`model`, `capacity` FROM `tbl_vehicles`
				 INNER JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id INNER JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id WHERE `plate` = ?",
					$this->plate);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Company not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT tbl_vehicles.id,`plate`, `make`,`model`, `capacity` FROM `tbl_vehicles`
				 INNER JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id INNER JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id ");
			return $res;
		}

		function add_vehicle($plate,  $model_id, $capacity){
			//pre($profile);
			if($this->searchName($plate)){
				return array('error' => 'vehicle already exists');
			}else{
					//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
					$res = query("INSERT INTO `tbl_vehicles` (`plate`,`model_id`,`capacity`) 
						VALUES (?,?,?)",$plate,  $model_id, $capacity);
					$this->plate = $plate;				
					/*//regenerate token expiry key
					$token = new Token();
					$t = $token->generateToken($this->uid,$api_access);*/
					return array('vehicle' => $this->getVehicle());
				}
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
		}

		function get_vehicle($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`plate`,`model_id`,`capacity` FROM `tbl_vehicles` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'vehicle does not exist');
			}else{
				$this->plate = $res[0]["plate"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getVehicle();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function update_vehicle($id,$plate,$model_id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`plate`,`model_id`,`capacity` FROM `tbl_vehicles` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'vehicle does not exist');
			}else{
				$this->plate = $res[0]["plate"];
				query("UPDATE `tbl_vehicles` SET `plate`=?, `model_id`=? WHERE `id`=?",
					$plate,$model_id,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array('vehicle' => $this->getVehicle());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function delete_vehicle($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`plate`,`model_id`,`capacity` FROM `tbl_vehicles` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'vehicle does not exist');
			}else{
				$this->plate = $res[0]["plate"];
				query("DELETE FROM `tbl_vehicles` WHERE `id`=?",
					$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array('vehicle' => $res[0]);
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}


		static function searchName($plate){
			$res = query("SELECT * FROM `tbl_vehicles` WHERE `plate` = ?",$plate);
			if($res == null){
				return false;
			}
			if(isset($res[1])){
				return array('error' => 'vehicle already exists');
			}
			return true;
		}
	}
?>