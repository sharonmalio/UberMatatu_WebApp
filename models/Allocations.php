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
				$res = query("SELECT `id`, `vehicle_id`, `driver_id`, `collect_time`, `return_time`, `start_milage`, `return_milage` FROM `tbl_allocation` WHERE   `vehicle_id`= ?",$this->vehicle_id);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Allocation not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT `id`, `vehicle_id`, `driver_id`, `collect_time`, `return_time`, `start_milage`, `return_milage` FROM `tbl_allocation`");
			return $res;
		}

		function add_allocation($vehicle_id,$driver_id,$start_milage){
			$date = date('Y-m-d H:i:s');
			//pre($profile);
			if($this->searchVehicle($vehicle_id)){
				return array('error' => 'Vehicle already allocated');
			}else{
					//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
					$res = query("INSERT INTO `tbl_allocation` (`vehicle_id`,`driver_id`,`collect_time`,`start_milage`) 
						VALUES (?,?,?,?)",$vehicle_id, $driver_id, $date,$start_milage);
					$this->vehicle_id = $vehicle_id;

					$res = query("UPDATE `tbl_vehicles` SET `vehicle_use`= ? WHERE `id` = ?", 1,$vehicle_id);				
					//regenerate token expiry key
					/*$token = new Token();
					$t = $token->generateToken($this->uid,$api_access);*/
					return $this->getAllocation();
				}
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
		}

		function get_allocation($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`, `vehicle_id`, `driver_id`, `collect_time`, `return_time`, `start_milage`, `return_milage` FROM `tbl_allocation` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'allocation does not exist');
			}else{
				$this->vehicle_id= $res[0]["vehicle_id"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getAllocation();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function update_allocation($id,$return_milage){
			$date = date('Y-m-d H:i:s');
			//return $id;
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`, `vehicle_id`, `driver_id`, `collect_time`, `return_time`, `start_milage`, `return_milage` FROM `tbl_allocation` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'allocation does not exist');
			}else{
				$this->vehicle_id = $res[0]["vehicle_id"];
				$res=query("UPDATE `tbl_allocation` SET `return_time` = ?, `return_milage`=? WHERE `id`=?",$date,
					$return_milage,$id);

				$res = query("UPDATE `tbl_vehicles` SET `vehicle_use`= ? WHERE `id` = ?", 0,$this->vehicle_id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getAllocation());
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