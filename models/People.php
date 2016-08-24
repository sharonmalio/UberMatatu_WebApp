<?php
	class People
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $user_id = "";
		
		function __construct(){
		}

		function getPerson(){
			//pre($this->email);
			if($this->user_id != null){	
				$res = query("SELECT tbl_people.id,`fName`,`lName`,`user_id`,`phone_no`,`type_name`
					FROM `tbl_people`
					LEFT JOIN tbl_people_type ON tbl_people.type=tbl_people_type.id
				 	WHERE  `user_id`= ?",$this->user_id);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Person not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT tbl_people.id,`fName`,`lName`,`user_id`,`phone_no`,`type_name` 
				FROM `tbl_people`
				LEFT JOIN tbl_people_type ON tbl_people.type=tbl_people_type.id");
			return $res;
		}

		/*function add_person($fName, $lName, $phone_no, $type, $user_id){
			//pre($profile);
			if($this->searchName($user_id)){
				return array('error' => 'person already exists');
			}else{
					//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
					$res = query("INSERT INTO `tbl_people` (`fName`,`lName`,`phone_no`,`type`,`user_id`) 
						VALUES (?,?,?,?,?)",$fName, $lName, $phone_no, $type, $user_id);
					$this->user_id = $user_id;				
					//regenerate token expiry key
					$token = new Token();
					$t = $token->generateToken($this->uid,$api_access);
					return $this->getPerson();
				}
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
		}*/

		function get_person($user_id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`fName`,`lName`,`phone_no`,`type`, `user_id` FROM `tbl_people` WHERE `user_id` = ?",$user_id);
			if ($res==null) {
				return array('error' => 'person does not exist');
			}else{
				$this->user_id = $res[0]["user_id"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getPerson();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function self_update_person($user_id, $fName, $lName, $phone_no, $type){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`fName`,`lName`,`phone_no`,`user_id` FROM `tbl_people` WHERE `user_id`=?",
				$user_id);
			if ($res==null) {
				return array('error' => 'person does not exist');
			}else{
				return $type;
				$this->user_id = $res[0]["user_id"];
				query("UPDATE `tbl_people` SET `fName`=?,`lName`=?,`phone_no`=?,`type`=? WHERE `user_id`=?",
					$fName, $lName, $phone_no, $type,$user_id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getPerson());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function update_person($user_id, $fName, $lName, $phone_no, $type){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`fName`,`lName`,`phone_no`,`type`,`user_id` FROM `tbl_people` WHERE `user_id`=?",$user_id);
			if ($res==null) {
				return array('error' => 'person does not exist');
			}else{
				return $type;
				$this->user_id = $res[0]["user_id"];
				query("UPDATE `tbl_people` SET `fName`=?,`lName`=?,`phone_no`=?,`type`=? WHERE `user_id`=?",
					$fName, $lName, $phone_no,$type,$user_id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getPerson());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function delete_person($user_id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`fName`,`lName`,`phone_no`,`type`,`user_id` FROM `tbl_people` WHERE `user_id`=?",
				$user_id);
			if ($res==null) {
				return array('error' => 'person does not exist');
			}else{
				$this->user_id = $res[0]["user_id"];
				query("DELETE FROM `tbl_people` WHERE `user_id`=?",
					$user_id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array('person' => $res[0]);
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}


		static function searchName($user_id){
			$res = query("SELECT * FROM `tbl_people` WHERE `user_id` = ?",$user_id);
			if($res == null){
				return false;
			}
			if(isset($res[0])){
				return array('error' => 'person already exists');
			}
			return true;
		}
	}
?>