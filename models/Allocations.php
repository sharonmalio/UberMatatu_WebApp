<?php
	class Allocations
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $allocation = "";
		
		function __construct(){
		}

		function getAllocation(){
			//pre($this->email);
			if($this->vehicle_id != null){	
				$res = query("SELECT tbl_allocation.id, `vehicle_id`, `driver_id`, `collect_time`, `return_time`, `start_mileage`, `return_mileage`,`plate`,`fName`, `lName` FROM `tbl_allocation`
				INNER JOIN `tbl_people` ON tbl_allocation.driver_id = tbl_people.user_id
				INNER JOIN `tbl_vehicles` ON tbl_allocation.vehicle_id = tbl_vehicles.id
				 WHERE   `vehicle_id`= ? AND `return_time` IS NULL ",$this->vehicle_id);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Allocation not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT tbl_allocation.id, `vehicle_id`,`plate`,`make`,`model`,`capacity`, `driver_id`,`fName`, `lName`, `collect_time`, `return_time`, `start_mileage`, `return_mileage` FROM `tbl_allocation`
				INNER JOIN `tbl_people` ON tbl_allocation.driver_id = tbl_people.user_id
				INNER JOIN `tbl_vehicles` ON tbl_allocation.vehicle_id = tbl_vehicles.id
				INNER JOIN `tbl_vehicle_model` ON tbl_vehicles.model_id = tbl_vehicle_model.id
				INNER JOIN `tbl_vehicle_make` ON tbl_vehicle_make.id = tbl_vehicle_model.make_id ");
			return $res;
		}

		function add_allocation($vehicle_id,$driver_id,$start_mileage){
			$date = date('Y-m-d H:i:s');
			//pre($profile);
			if($this->searchVehicle($vehicle_id)){
				return array('error' => 'Vehicle already allocated');
			}else{
					//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
					$res = query("INSERT INTO `tbl_allocation` (`vehicle_id`,`driver_id`,`collect_time`,`start_mileage`) 
						VALUES (?,?,?,?)",$vehicle_id, $driver_id, $date,$start_mileage);
					$this->vehicle_id = $vehicle_id;

					$res = query("UPDATE `tbl_vehicles` SET `vehicle_use`= ? WHERE `id` = ?", 1,$vehicle_id);
					$res = query("UPDATE `tbl_people` SET `allocation_status`= ? WHERE `user_id` = ? AND `type` = ?", 1,$driver_id,2);				
					
					return $this->getAllocation();
				}
				
		}

		function get_allocation($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`, `vehicle_id`, `driver_id`, `collect_time`, `return_time`, `start_mileage`, `return_mileage` FROM `tbl_allocation` WHERE `vehicle_id` = ? AND `return_time` IS NULL ",$id);
			if ($res==null) {
				return array('error' => 'allocation does not exist');
			}else{
				$this->allocation_id= $res[0]["id"];
				$this->vehicle_id=$res[0]["vehicle_id"];				
				
				return $this->getAllocation();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function update_allocation($id,$return_mileage){
			$date = date('Y-m-d H:i:s');
			//return $id;
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`, `vehicle_id`, `driver_id`, `collect_time`, `return_time`, `start_mileage`, `return_mileage` FROM `tbl_allocation` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'allocation does not exist');
			}else{

				$driver_id = $res[0]['driver_id'];

				$this->vehicle_id = $res[0]["vehicle_id"];
				$res=query("UPDATE `tbl_allocation` SET `return_time` = ?, `return_mileage`=? WHERE `id`=?",$date,
					$return_mileage,$id);

				$res = query("UPDATE `tbl_vehicles` SET `vehicle_use`= ? WHERE `id` = ? ", 0,$this->vehicle_id);
				$res = query("UPDATE `tbl_people` SET `allocation_status`= ? WHERE `user_id` = ? AND `type` = ?",0,$driver_id,2);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				$res1 = query("SELECT tbl_allocation.id, `vehicle_id`,`plate`,`make`,`model`,`capacity`, `driver_id`,`fName`, `lName`, `collect_time`, `return_time`, `start_mileage`, `return_mileage` FROM `tbl_allocation`
				INNER JOIN `tbl_people` ON tbl_allocation.driver_id = tbl_people.user_id
				INNER JOIN `tbl_vehicles` ON tbl_allocation.vehicle_id = tbl_vehicles.id
				INNER JOIN `tbl_vehicle_model` ON tbl_vehicles.model_id = tbl_vehicle_model.id
				INNER JOIN `tbl_vehicle_make` ON tbl_vehicle_make.id = tbl_vehicle_model.make_id 
				 WHERE tbl_allocation.id = ? ", $id);
				
				return $res1[0];
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function delete_allocation($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`allocation`,`make_id` FROM `tbl_allocation` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'allocation does not exist');
			}else{
				$this->name = $res[0]["allocation"];
				query("DELETE FROM `tbl_allocation` WHERE `id`=?",
					$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array('allocation' => $res[0]);
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}


		static function searchVehicle($vehicle_id){
			$res = query("SELECT * FROM `tbl_vehicles` WHERE `id` = ? AND `vehicle_use` = 1",$vehicle_id);
			if($res == null){
				return false;
			}
			if(isset($res[0])){
				return array('error' => 'vehicle already allocated');
			}
			return true;
		}
	}
?>