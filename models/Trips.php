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
				$res = query("SELECT tbl_trips.id,`start_mileage`,`end_mileage`,`trip_date`,`trip_time`,`date`,`vehicle_id`,`plate`, `make`,`model`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`start_location`,`end_coordinate`,`end_location`,`approval` FROM `tbl_trips`
				LEFT JOIN `tbl_vehicles` ON tbl_vehicles.id = tbl_trips.vehicle_id
				LEFT JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id 
				 LEFT JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id
				 	WHERE  tbl_trips.id= ?",$this->trips);


				$res1 = query("SELECT `fName`, `lName`,`phone_no` FROM `tbl_allocation`
				INNER JOIN `tbl_people` ON tbl_allocation.driver_id = tbl_people.user_id
				INNER JOIN `tbl_vehicles` ON tbl_allocation.vehicle_id = tbl_vehicles.id
				 WHERE   `vehicle_id`= ?  ",$res[0]['vehicle_id']);

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
						$res[0]['driver'][]= $res1[0];
					}
					 

					 return $res;
				}else{
					return array('error' => 'Trips not found' );
				}
				
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT tbl_trips.id,`start_mileage`,`end_mileage`,`trip_date`,`trip_time`,`date`,`vehicle_id`,`plate`, `make`,`model`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`start_location`,`end_coordinate`,`end_location`,`approval` FROM `tbl_trips`
				LEFT JOIN `tbl_vehicles` ON tbl_vehicles.id = tbl_trips.vehicle_id
				LEFT JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id 
				 LEFT JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id 
					");
			$car = ["vehicle_id"];


			return $res;
		}

		function add_trip($trip_creator,$start_coordinate,$start_location,$end_coordinate,$end_location,$trip_date,$trip_time){

			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$tripID = query("INSERT INTO `tbl_trips` (`trip_creator`,`start_coordinate`,`start_location`,`end_coordinate`,`end_location`,`trip_date`,`trip_time`) 
				VALUES (?,?,?,?,?,?,?)",$trip_creator,$start_coordinate,$start_location,$end_coordinate,$end_location,$trip_date,$trip_time);
			//pre($tripID);
			// $res = query("SELECT * FROM `tbl_trips` WHERE `id` = ?",$tripID);
			//pre($res);
			$this->trips = $tripID;
			return $this->getTrip();
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
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function get_usertrips($user_id){

			$res = query("SELECT `id`,`start_mileage`,`end_mileage`,`trip_date`,`trip_time`,`date`,`vehicle_id`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate`, `approval` FROM `tbl_trips` WHERE trip_creator = ?",$user_id);
			if($res == null){
				return array('error' => 'User has no created trips');
			}else{
				return $res;
			}
		}

		function get_mytrips($trip_creator){


			$res = query("SELECT `id`,`start_mileage`,`end_mileage`,`trip_date`,`trip_time`,`date`,`vehicle_id`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate`, `approval` FROM `tbl_trips` WHERE trip_creator = ?",$trip_creator);
			if($res == null){
				return array('error' => 'You have no created trips');
			}else{
				return $res;
			}
		}
		function update_trips($id,$start_coordinate,$end_coordinate,$trip_date,$trip_time){
			//return $id;
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`start_mileage`,`end_mileage`,`trip_date`,`trip_time`,`date`,`vehicle_id`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate` FROM `tbl_trips`, `approval` WHERE `id` = ? AND `approval`= ?",$id,0);
			if ($res==null) {
				return array('error' => 'trips does not exist');
			}else{
				$this->trips = $res[0]["id"];
				$res=query("UPDATE `tbl_trips` SET `trip_date`=?,`trip_time`=?, `start_coordinate`,`end_coordinate`  WHERE `id`=?",
					$trip_date,$trip_time,$start_coordinate,$end_coordinate,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getTrip());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function approve_trip($id){
			$res = query("SELECT `id` FROM `tbl_trips` WHERE `id` = ? AND `approval`= ?",$id, 0);
			if($res == null){
				return array('error'=>'trip has already been approved');
			}
			else{
				$this->trips = $res[0]["id"];
				$res=query("UPDATE `tbl_trips` SET `approval`=? WHERE `id`=?",
					1,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getTrip();

			}
		}

		function start_trip($id,$start_mileage){
			$res = query("SELECT `id`,`start_mileage`,`end_mileage`,`date`,`vehicle_id`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate`, `approval` FROM `tbl_trips` WHERE `id` = ? AND `approval`= ?",$id, 1);
			if($res == null){
				return array('error'=>'trip has not approved');
			}
			else{
				$date = date('Y-m-d H:i:s');
				$this->trips = $res[0]["id"];
				$res=query("UPDATE `tbl_trips` SET `start_mileage`=?,`start_time`=? WHERE `id`=?",
					$start_mileage,$date,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getTrip());

			}
		}

		function stop_trip($id,$end_mileage){
			$res = query("SELECT `id`,`start_mileage`,`end_mileage`,`date`,`vehicle_id`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate`, `approval` FROM `tbl_trips` WHERE `id` = ?",$id);
			if($res == null){
				return array('error'=>'trip does not exist');
			}
			else{
				$date = date('Y-m-d H:i:s');
				$this->trips = $res[0]["id"];
				$res=query("UPDATE `tbl_trips` SET `end_mileage`=?,`stop_time`=? WHERE `id`=?",
					$end_mileage,$date,$id);

				$res = query("UPDATE `tbl_vehicles` SET `vehicle_dispatched` = ? WHERE `id`=?",0,$vehicle_id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getTrip());

			}
		}

		function dispatch_vehicle($vehicle_id, $trip_id){
			$res = query("UPDATE `tbl_trips` SET `vehicle_id` = ? WHERE `id` = ?",$vehicle_id,$trip_id);

			$res = query("UPDATE `tbl_vehicles` SET `vehicle_dispatched` = ? WHERE `id`=?",1,$vehicle_id);

			$res = query("SELECT `id`,`start_mileage`,`end_mileage`,`trip_date`,`trip_time`,`date`,`vehicle_id`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate`, `approval`
					FROM `tbl_trips` WHERE `id`= ?",$trip_id);
					return $res[0];

		}

		function delete_trip($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`start_mileage`,`end_mileage`,`date`,`vehicle_id`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate`, `approval` FROM `tbl_trips` WHERE `id`=?",
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
				return array('trips' => $res[0]);
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