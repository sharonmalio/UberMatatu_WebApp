<?php
	class Projectmanagers
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $projectmanager = "";
		
		function __construct(){
		}

		function getProjectmanager(){
			//pre($this->email);
			if($this->projectmanager != null){	
				$res = query("SELECT tbl_vehicle_projectmanager.id as projectmanager_id,`projectmanager`,`make_id`,`make`
					FROM `tbl_vehicle_projectmanager`
					LEFT JOIN `tbl_vehicle_make` ON `make_id`=tbl_vehicle_make.id
				 	WHERE  `projectmanager`= ?",$this->projectmanager);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Projectmanager not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT `id`,`fName`,`lName`,`phone_no`,`type`, `user_id` FROM `tbl_people` WHERE `type` = 3");
			return $res;
		}

	

		function get_projectmanager($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`fName`,`lName`,`phone_no`,`type`, `user_id` FROM `tbl_people` WHERE `type` = 3 AND `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'projectmanager does not exist');
			}else{
				$this->projectmanager = $res[0]["projectmanager"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getProjectmanager();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}
	}
?>