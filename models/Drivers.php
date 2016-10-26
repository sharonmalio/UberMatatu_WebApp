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
					if ($res[0]['allocation_status'] == 1) {
						$res1 = query("SELECT tbl_allocation.id, `vehicle_id`,`plate`, `make`,`model`, `capacity` FROM tbl_allocation
						INNER JOIN tbl_vehicles ON tbl_vehicles.id = tbl_allocation.vehicle_id
						INNER JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id
						INNER JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id 
					 	WHERE driver_id = ? AND return_mileage IS NULL",$this->drivers);

					$res2 = query("SELECT id, start_location, end_location FROM tbl_trips WHERE allocation_id =? ", $res1[0]['id']);

					$res[0]['vehicle'] = $res1[0];

					$res[0]['trip']=$res2[0];
					}
					
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

			foreach ($res as $driver_key => $driver) {
				if ($driver['allocation_status'] == 1) {

					$res1 = query("SELECT tbl_allocation.id, `vehicle_id`,`plate`, `make`,`model`, `capacity` FROM tbl_allocation
						INNER JOIN tbl_vehicles ON tbl_vehicles.id = tbl_allocation.vehicle_id
						INNER JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id
						INNER JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id 
					 	WHERE driver_id = ? AND return_mileage IS NULL",$driver['id']);

					$res2 = query("SELECT id, start_location, end_location FROM tbl_trips WHERE allocation_id =? ", $res1[0]['id']);

					$res[0]['vehicle'] = $res1[0];

					$res[0]['trip']=$res2[0];
				 	
				 	$res3[] = $res[0];
				 } 
			}
			return $res3;
		}


		function get_driver($id){
			$res = query("SELECT tbl_people.id, `fName`, `lName`, `email`,`phone_no`, `type`, `user_id`, `allocation_status` FROM `tbl_people`
			 INNER JOIN `tbl_users` ON tbl_people.user_id = tbl_users.id WHERE tbl_people.user_id = ?",$id);
			if ($res==null) {
				return array('error' => 'driver does not exist');
			}else{
				$this->drivers = $res[0]["id"];				
				
				return $this->getDriver();
			
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