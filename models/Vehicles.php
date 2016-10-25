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
				$res = query("SELECT tbl_vehicles.id,`plate`, `make`,`model`, `capacity`,`vehicle_use`,`vehicle_dispatched` FROM `tbl_vehicles`
				 INNER JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id
				 INNER JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id WHERE `plate` = ?",
					$this->plate);

				if ($res[0]['vehicle_use'] == 1) {
					$res1 = query("SELECT tbl_allocation.id AS allocation_id,  driver_id, fName, lName, phone_no, email FROM tbl_allocation
					INNER JOIN tbl_vehicles ON tbl_allocation.vehicle_id = tbl_vehicles.id
					INNER JOIN tbl_people ON tbl_people.user_id = tbl_allocation.driver_id 
					INNER JOIN tbl_users ON tbl_users.id =  tbl_people.user_id 	
					WHERE tbl_vehicles.id = ? AND return_mileage IS NULL",$res[0]['id']);

					

					$res3 = query("SELECT id as trip_id, start_location, end_location FROM tbl_trips WHERE allocation_id = ?", $res1[0]['allocation_id']);

					$res[0]['driver'] = $res1[0];

					$res[0]['trip'] = $res3[0];
					
				}

				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Vehicle not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT tbl_vehicles.id,`plate`, `make`,`model`, `capacity`,`vehicle_use`,`vehicle_dispatched` FROM `tbl_vehicles`
				 INNER JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id 
				 INNER JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id
				  ");

			foreach ($res as $vehicle_key => $vehicle) {
				if ($vehicle['vehicle_use'] == 1) {
					$res1 = query("SELECT tbl_allocation.id AS allocation_id, driver_id, fName, lName, phone_no, email FROM tbl_allocation
					INNER JOIN tbl_vehicles ON tbl_allocation.vehicle_id = tbl_vehicles.id
					INNER JOIN tbl_people ON tbl_people.user_id = tbl_allocation.driver_id
					INNER JOIN tbl_users ON tbl_users.id =  tbl_people.user_id 
					WHERE tbl_vehicles.id = ? AND return_mileage IS NULL",$vehicle['id']);

					$res3 = query("SELECT id as trip_id, start_location, end_location FROM tbl_trips WHERE allocation_id = ? AND end_mileage IS NULL", $res1[0]['allocation_id']);

					
					$vehicle['driver']= $res1[0];
					if ($res3 != null) {
						$vehicle['trip'] = $res3[0];
						$res2[] = $vehicle;


						# code...
					}else{
						$res2[] = $vehicle;
					}
					//$vehicle['trip'] = $res3[0];
					
				}
				else{
					$res2[]=$vehicle;
				}
				
			}
			return $res2	;
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
			$res = query("SELECT `id`,`plate`,`model_id`,`capacity`,`vehicle_use`,`vehicle_dispatched` FROM `tbl_vehicles` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'vehicle does not exist');
			}else{
				$this->plate = $res[0]["plate"];				
		
			 return $this->getVehicle();
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