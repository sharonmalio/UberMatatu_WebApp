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
			$res = query("SELECT `id`,`start_milage`,`end_milage`,`date`,`vehicle_driver`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`end_coordinate`
					FROM `tbl_trips`");
			return $res;
		}

		function add_trip($trip_creator,$start_coordinate,$end_coordinate){

			//pre($profile);
			/*if($this->searchName($trips)){
				return array('error' => 'trips already exists');
			}else{*/
					//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
					$res = query("INSERT INTO `tbl_trips` (`trip_creator`,`start_coordinate`,`end_coordinate`) 
						VALUES (?,?,?)",$trip_creator,$start_coordinate,$end_coordinate);
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

		function update_trips($id,$trips,$make_id){
			//return $id;
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`trips`,`make_id` FROM `tbl_vehicle_trips` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'trips does not exist');
			}else{
				$this->trips = $res[0]["trips"];
				$res=query("UPDATE `tbl_vehicle_trips` SET `trips`=?,`make_id`=? WHERE `id`=?",
					$trips,$make_id,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getTrip());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
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