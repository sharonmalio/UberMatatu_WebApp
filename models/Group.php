<?php
	class Grouptrips
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $trips = "";
		
		function __construct(){
		}

		function getGrouptrip(){
			//pre($this->email);
			if($this->trips != null){	
				$res = query("SELECT tbl_group_trip.id,`trip_id`,tbl_group_trip.user_id,`fName`,`lName`
					FROM `tbl_group_trip` INNER JOIN `tbl_people` ON tbl_group_trip.user_id = tbl_people.user_id
				 	WHERE  `trip_id`= ? ORDER BY `trip_id`",$this->trips);
				if(isset($res[0])){
					return $res;
				}else{
					return array('error' => 'Grouptrip not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT tbl_group_trip.id,`trip_id`,tbl_group_trip.user_id,`fName`,`lName`
					FROM `tbl_group_trip` INNER JOIN `tbl_people` ON tbl_group_trip.user_id = tbl_people.user_id ");
			return $res;
		}

		function add_grouptrip($trip_id,$user_id){

			//pre($profile);
			if($this->searchName($trip_id,$user_id)){
				return array('error' => 'User in trip already exists');
			}else{
					//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
					$res = query("INSERT INTO `tbl_group_trip` (`trip_id`,`user_id`) 
						VALUES (?,?)",$trip_id,$user_id);
					// $this->trips = $trips;				
					//regenerate token expiry key
					/*$token = new Token();
					$t = $token->generateToken($this->uid,$api_access);*/
					return $this->getGrouptrip();
				}
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
	 }

		function get_grouptrip($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`trip_id`,`user_id`
					FROM `tbl_group_trip` WHERE `trip_id` = ?",$id);
			if ($res==null) {
				return array('error' => 'Group trip does not exist');
			}else{
				$this->trips = $res[0]["trip_id"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getGrouptrip();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function update_grouptrips($id,$trip_id,$user_id){
			//return $id;
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`trip_id`,`user_id`
					FROM `tbl_group_trip` WHERE `trip_id` = ? AND `user_id` = ? ",$trip_id, $user_id);
			if ($res==null) {
				return array('error' => 'User does not exist in the selected trip');
			}else{
				$this->trips = $res[0]["trips"];
				$res=query("UPDATE `tbl_group_trip` SET `user_id` = ? WHERE `id`=?",
					$user_id,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getGrouptrip());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function delete_grouptrip($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`trip_id`,`user_id`
					FROM `tbl_group_trip` WHERE `trip_id` =?",
				$id);
			if ($res==null) {
				return array('error' => 'trip does not exist');
			}else{
				$this->id = $res[0]["id"];
				query("DELETE FROM `tbl_group_trip` WHERE `trip_id`=? ",
					$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array('trips' => $res);
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}


		static function searchName($trip_id, $user){
			$res = query("SELECT * FROM `tbl_group_trip` WHERE `trip_id` = ? AND `user_id` = ?",$trip_id, $user);
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