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
				$res = query("SELECT `id`,`start_milage`,`end_milage`,`date`,`vehicle_driver`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate`
					FROM `tbl_trips`
				 	WHERE  `id`= ?",$this->trips);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Trips not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT `id`,`start_milage`,`end_milage`,`trip_date`,`trip_time`,`date`,`vehicle_driver`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate`
					FROM `tbl_trips`");
			return $res;
		}

		function add_trip($trip_creator,$start_coordinate,$end_coordinate,$trip_date,$trip_time){

			//pre($profile);
			/*if($this->searchName($trips)){
				return array('error' => 'trips already exists');
			}else{*/
					//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
					$res = query("INSERT INTO `tbl_trips` (`trip_creator`,`start_coordinate`,`end_coordinate`,`trip_date`,`trip_time`) 
						VALUES (?,?,?,?,?)",$trip_creator,$start_coordinate,$end_coordinate,$trip_date,$trip_time);
					// $this->trips = $trips;				
					//regenerate token expiry key
					/*$token = new Token();
					$t = $token->generateToken($this->uid,$api_access);*/
					return $this->getTrip();
				}
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
		// }

		function get_trip($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`start_milage`,`end_milage`,`date`,`vehicle_driver`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate` FROM `tbl_trips` WHERE `id` = ?",$id);
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

		function update_trips($id,$trip_date,$trip_time){
			//return $id;
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`start_milage`,`end_milage`,`date`,`vehicle_driver`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate` FROM `tbl_trips` WHERE `id` = ? AND `approval`= ?",$id,0);
			if ($res==null) {
				return array('error' => 'trips does not exist');
			}else{
				$this->trips = $res[0]["id"];
				$res=query("UPDATE `tbl_trips` SET `trip_date`=?,`trip_time`=? WHERE `id`=?",
					$trip_date,$trip_time,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getTrip());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function start_trip($id,$start_milage){
			$res = query("SELECT `id`,`start_milage`,`end_milage`,`date`,`vehicle_driver`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate` FROM `tbl_trips` WHERE `id` = ? AND `approval`= ?",$id, 1);
			if($res == null){
				return array('error'=>'trip has not approved');
			}
			else{
				$date = date('Y-m-d H:i:s');
				$this->trips = $res[0]["id"];
				$res=query("UPDATE `tbl_trips` SET `start_milage`=?,`start_time`=? WHERE `id`=?",
					$start_milage,$date,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getTrip());

			}
		}

		function stop_trip($id,$start_milage){
			$res = query("SELECT `id`,`start_milage`,`end_milage`,`date`,`vehicle_driver`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate` FROM `tbl_trips` WHERE `id` = ?",$id);
			if($res == null){
				return array('error'=>'trip does not exist');
			}
			else{
				$date = date('Y-m-d H:i:s');
				$this->trips = $res[0]["id"];
				$res=query("UPDATE `tbl_trips` SET `end_milage`=?,`stop_time`=? WHERE `id`=?",
					$start_milage,$date,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getTrip());

			}
		}

		function delete_trip($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`start_milage`,`end_milage`,`date`,`vehicle_driver`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate` FROM `tbl_trips` WHERE `id`=?",
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