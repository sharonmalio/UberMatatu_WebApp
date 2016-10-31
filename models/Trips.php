 <?php
	class Trips
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $trips = "";
		
		function __construct(){
		}

		function getTrip(){
			//pre($this->email);
			if($this->trips != null){	
				$res = query("SELECT tbl_trips.id,`start_mileage`,`end_mileage`,`start_coordinate`,`start_location`,`end_coordinate`,`end_location`,`trip_date`,`trip_time`,`date`,`allocation_id`,`start_time`,`stop_time`,`trip_creator`,`fName`, `lName`,`phone_no`,`project_id`,`name` AS Project_name,`status`,`approval`,`fare_estimate`,`actual_fare` FROM `tbl_trips`
					INNER JOIN `tbl_people` ON tbl_people.user_id = tbl_trips.trip_creator
					LEFT JOIN `tbl_trip_approval_status` ON tbl_trip_approval_status.id = tbl_trips.approval
					LEFT JOIN `tbl_projects` ON tbl_projects.id = tbl_trips.project_id  
				
				 	WHERE  tbl_trips.id= ?",$this->trips);

				$res1 = query("SELECT `fName`, `lName`,`phone_no` FROM `tbl_allocation`
				INNER JOIN `tbl_people` ON tbl_allocation.driver_id = tbl_people.user_id
				
				WHERE   tbl_allocation.id= ?  ",$res[0]['allocation_id']);

				//pre($res);
				if(isset($res[0])){
					// return $res;
					$mGroup = new Grouptrips();
					$gtrips = $mGroup->get_grouptrip($this->trips);
					//pre($gtrips);
					if(count($gtrips) != 0 && !array_key_exists('error', $gtrips)){
						foreach ($gtrips as $gtrip_key => $user) {
							//pre($user);
							$res[0]['group'][] = $user['email']; 
						}
					}
					if (isset($res1[0])) {
						// foreach ($res1 as $key => $value) {
						// 	$res[0]['driver'][]= $res1[$key];
						// }
						$res[0]['driver']= $res1[0];

						$res3 = query("SELECT `vehicle_id`,`plate`, `make`,`model` FROM `tbl_allocation`
						INNER JOIN `tbl_vehicles` ON tbl_allocation.vehicle_id = tbl_vehicles.id
						INNER JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id 
						INNER JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id
						WHERE   tbl_allocation.id= ?  ",$res[0]['allocation_id']);

						$res[0]['vehicle'] = $res3[0];
					}
					 
					$res[0]['vehicle_driver'] =  array_merge($res[0]['vehicle'],$res[0]['driver']);
					 return $res[0];
				}else{
					return array('error' => 'Trips not found' );
				}
				
			}
		}



		function all(){
			//pre($profile);
			$res = query("SELECT tbl_trips.id,`start_coordinate`,`start_location`,`end_coordinate`,`end_location`,`trip_date`,`trip_time`,`date`,`allocation_id`,`plate`, `make`,`model`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`start_location`,`end_coordinate`,`end_location`,`project_id`,`name` AS project_name,`status`,`approval`,`fare_estimate`,`actual_fare` FROM `tbl_trips`
				LEFT JOIN `tbl_allocation` ON tbl_trips.allocation_id = tbl_allocation.id
				LEFT JOIN `tbl_vehicles` ON tbl_vehicles.id = tbl_allocation.vehicle_id
				LEFT JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id 
				LEFT JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id
				LEFT JOIN `tbl_trip_approval_status` ON tbl_trip_approval_status.id = tbl_trips.approval
				LEFT JOIN `tbl_projects` ON tbl_projects.id = tbl_trips.project_id 
					");
			$car = ["allocation_id"];

			foreach ($res as $trip_key => $trip) {
				if ($trip['allocation_id'] != null) {
					$res1 = query("SELECT `fName`, `lName`,`phone_no` FROM `tbl_allocation`
						INNER JOIN `tbl_people` ON tbl_allocation.driver_id = tbl_people.user_id
						WHERE   tbl_allocation.id= ?  ",$trip['allocation_id']);
					
					$trip['driver']= $res1[0];

					$res3 = query("SELECT `vehicle_id`,`plate`, `make`,`model` FROM `tbl_allocation`
						INNER JOIN `tbl_vehicles` ON tbl_allocation.vehicle_id = tbl_vehicles.id
						INNER JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id 
						INNER JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id
						WHERE   tbl_allocation.id= ?  ",$trip['allocation_id']);

					$trip['vehicle'] = $res3[0];
					
					$res2[] = $trip;
				}
				else{
					$res2[]=$trip;
				}
				
			}

			return $res2;
		}

		function add_trip($trip_creator,$start_coordinate,$start_location,$end_coordinate,$end_location,$trip_date,$trip_time,$project_id, $fare_estimate){
			
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$tripID = query("INSERT INTO `tbl_trips` (`trip_creator`,`start_coordinate`,`start_location`,`end_coordinate`,`end_location`,`trip_date`,`trip_time`,`project_id`,`fare_estimate`) 
				VALUES (?,?,?,?,?,?,?,?,?)",$trip_creator,$start_coordinate,$start_location,$end_coordinate,$end_location,$trip_date,$trip_time,$project_id, $fare_estimate);
			//print_r($tripID);
			// $res = query("SELECT * FROM `tbl_trips` WHERE `id` = ?",$tripID['id']);
			$this->trips = $tripID;
			 return $this->getTrip();
		}

		function add_members($trip_id,$email){
			// if($this->searchName($trip_id)){
			// 	return array('error' => 'Trip does not exists');
			// }else{
					$res = query("INSERT INTO `tbl_group_trip` (`trip_id`,`email`) 
						VALUES (?,?)",$trip_id,$email);
					
					return $this->get_trip($trip_id);
			// }
	 }

	 function remove_member($id){
	 	$res = query("SELECT `id`, `email` FROM `tbl_group_trip` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'member does not exist');
			}else{
				$this->id = $res[0]["id"];
				query("DELETE FROM `tbl_group_trip` WHERE `id`=?",
					$id);
				
				return array('Removed trip member' => $res[0]['email']);
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
	 }
		function get_trip($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id` FROM `tbl_trips` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'trip does not exist');
			}else{
				$this->trips = $res[0]["id"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getTrip();
			}
		}

		function get_usertrips($user_id){

			$res = query("SELECT * FROM `tbl_trips` WHERE trip_creator = ?",$user_id);
			if($res == null){
				return array('error' => 'User has no created trips');
			}else{
				return $res;
			}
		}
		function get_uncomplete($user_id){
			$res = query("SELECT * FROM `tbl_trips` WHERE `approval`  <> ? AND trip_creator = ?",4,$user_id);
			if($res == null){
				return array('error' => 'User has no created trips');
			}else{
				return $res;
			}

		}
		function get_mytrips($trip_creator){
			$res = query("SELECT tbl_trips.id,`start_mileage`,`end_mileage`,`start_coordinate`,`start_location`,`end_coordinate`,`end_location`,`trip_date`,`trip_time`,`date`,`allocation_id`,`start_time`,`stop_time`,`trip_creator`,`fName`, `lName`,`phone_no`,`project_id`,`name` AS Project_name,`status`,`approval`,`fare_estimate`,`actual_fare` FROM `tbl_trips`
					INNER JOIN `tbl_people` ON tbl_people.user_id = tbl_trips.trip_creator
					LEFT JOIN `tbl_trip_approval_status` ON tbl_trip_approval_status.id = tbl_trips.approval
					LEFT JOIN `tbl_projects` ON tbl_projects.id = tbl_trips.project_id  
				
				 	WHERE  tbl_trips.trip_creator= ?",$trip_creator);
			//$res = query("SELECT * FROM `tbl_trips` WHERE trip_creator = ?",$trip_creator);
			foreach ($res as $key => $trip) {				
				$res1 = query("SELECT `fName`, `lName`,`phone_no`,`vehicle_id`,`plate`, `make`,`model` FROM `tbl_allocation`
				INNER JOIN `tbl_people` ON tbl_allocation.driver_id = tbl_people.user_id
				INNER JOIN `tbl_vehicles` ON tbl_allocation.vehicle_id = tbl_vehicles.id
				INNER JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id 
				INNER JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id
				WHERE   tbl_allocation.id= ?  ",$res[$key]['allocation_id']);

				if (isset($res1[0])) {
					foreach ($res1 as $key1 => $value) {
						//$res[0]['driver'][]= $res1[$key];
						$res[$key]['vehicle_driver']= $res1[$key1];
					}
				} 

				$mGroup = new Grouptrips();
				$gtrips = $mGroup->get_grouptrip($res[$key]['id']);
				//pre($gtrips);
				if(count($gtrips) != 0 && !array_key_exists('error', $gtrips)){
					foreach ($gtrips as $gtrip_key => $user) {
						//pre($user);
						$res[$key]['group'][] = $user['email']; 
					}
				}		
			}
			return $res;

	
		}
		function update_trips($id,$start_coordinate,$start_location,$end_coordinate,$end_location,$trip_date,$trip_time){
			//return $id;
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id` FROM `tbl_trips`, `approval` WHERE `id` = ? AND `approval`= ?",$id,0);
			if ($res==null) {
				return array('error' => 'trips does not exist');
			}else{
				$this->trips = $res[0]["id"];
				$res=query("UPDATE `tbl_trips` SET `trip_date`=?,`trip_time`=?, `start_coordinate`,`start_location`,`end_coordinate`,`end_location`  WHERE `id`=?",
					$trip_date,$trip_time,$start_coordinate,$start_location,$end_coordinate,$end_location,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getTrip());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function approve_trip($decision,$id){
			$res = query("SELECT `id` FROM `tbl_trips` WHERE `id` = ? ",$id);
			if($res == null){
				return array('error'=>'trip does not exist');
			}
			else{
				$this->trips = $res[0]["id"];
				$res=query("UPDATE `tbl_trips` SET `approval`=? WHERE `id`=?",
					$decision,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getTrip();

			}
		}

		function start_trip($id,$start_mileage){
			$res = query("SELECT `id`,`approval` FROM `tbl_trips` WHERE `id` = ? AND `approval`= ?",$id, 2);
			if($res == null){
				return array('error'=>'Could not update trip');
			}
			else{
				$date = date('Y-m-d H:i:s');
				$this->trips = $res[0]["id"];
				$res=query("UPDATE `tbl_trips` SET `start_mileage`=?,`approval`= 5, `start_time`=? WHERE `id`=?",
					$start_mileage,$date,$id);
				return $this->getTrip();

			}
		}

		function stop_trip($id,$end_mileage){
			$res = query("SELECT `id`,`approval`,`allocation_id` FROM `tbl_trips` WHERE `id` = ?",$id);
			if($res == null){
				return array('error'=>'Trip not found');
			}
			else{
				$res = query("SELECT tbl_trips.id,`allocation_id`,tbl_trips.start_mileage, `vehicle_id` FROM `tbl_trips`

				INNER JOIN tbl_allocation ON tbl_allocation.id = tbl_trips.allocation_id WHERE 
				tbl_trips.id = ?",$id);

				//getting trip cost at 70 ksh per km
				$start = $res[0]['start_mileage'];
				$distance = ($end_mileage - $start);
				$fare =($distance * 70);

				$date = date('Y-m-d H:i:s');
				$this->trips = $id;

				$res1=query("UPDATE `tbl_trips` SET `end_mileage`=?,`stop_time`=?, `approval`= 4, `actual_fare` = ?  WHERE `id`=?",
					$end_mileage,$date,$fare,$id);
				$res2 = query("UPDATE `tbl_vehicles` SET `vehicle_dispatched` = ? WHERE `id`= ? ",0,$res[0]['vehicle_id']);
				return $this->getTrip();
			}
		}

		function dispatch_vehicle($allocation_id, $trip_id){
			$res = query("UPDATE `tbl_trips` SET `allocation_id` = ?, approval = 2 WHERE `id` = ?",$allocation_id,$trip_id);

			$res1 =query("SELECT * FROM tbl_allocation WHERE id =?", $allocation_id);
			$res = query("UPDATE `tbl_vehicles` SET `vehicle_dispatched` = ? WHERE `id`=?",1,$res1[0]['vehicle_id']);

			$res = query("SELECT `id`,`start_mileage`,`end_mileage`,`trip_date`,`trip_time`,`date`,`allocation_id`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate`, `approval`
					FROM `tbl_trips` WHERE `id`= ?",$trip_id);
					return $res[0];

		}

		function cancel_trip($trip_id){

			$res = query("UPDATE `tbl_trips` SET `approval` = 3 WHERE `id` =?", $trip_id);

			$res = query("SELECT * FROM `tbl_trips` WHERE `id`=?", $trip_id);
			$vehicle = $res[0]['allocation_id'];
			$res = query("UPDATE `tbl_vehicles` SET `vehicle_dispatched` = ? WHERE `id` = ?",0,$allocation_id);

			$res = query("SELECT `id`,`start_mileage`,`end_mileage`,`trip_date`,`trip_time`,`date`,`allocation_id`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate`, `approval`
					FROM `tbl_trips` WHERE `id`= ?",$trip_id);
				
				return $res[0];
		}

		function deny_trip($trip_id){
			$res = query("UPDATE `tbl_trips` SET `approval` = 6 WHERE `id` = ?", $trip_id);

			$res = query("SELECT * FROM `tbl_trips` WHERE `id`=?", $trip_id);
			$vehicle = $res[0]['allocation_id'];
			$res = query("UPDATE `tbl_vehicles` SET `vehicle_dispatched` = ? WHERE `id` = ?",0,$allocation_id);

			$res = query("SELECT `id`,`start_mileage`,`end_mileage`,`trip_date`,`trip_time`,`date`,`allocation_id`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate`, `approval`
					FROM `tbl_trips` WHERE `id`= ?",$trip_id);
				
				return $res[0];
		}

		function delete_trip($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`FROM `tbl_trips` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'trips does not exist');
			}else{
				$this->id = $res[0]["id"];
				query("DELETE FROM `tbl_trips` WHERE `id`=?",
					$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array('Deleted trip' => $res[0]);
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}


		static function searchName($trips){
			$res = query("SELECT * FROM `tbl_trips` WHERE `id` = ?",$trips);
			if($res == null){
				return false;
			}
			if(isset($res[0])){
				return array('error' => 'trips already exists');
			}
			return true;
		}
	}
?>