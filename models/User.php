<?php
	class User
	{
		private $uid = null;
		private $name = "";
		private $email = null;
		
		function __construct($uid = null){//,$email = null){
			$this->uid = $uid;
			//$this->email = $email;
		}

		function getUser(){
			//pre($this->email);
			if(!$this->email == null){	
				$res = query("SELECT `id`,`email` FROM `tbl_users` WHERE `email` = ?",
					$this->email);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'user not found' );;
				}
			}else{
				if($this->uid == null){
					return array('error' => 'user not set');
				}else{
					$res = query("SELECT `id`,`email` FROM `tbl_users` WHERE `id` = ?",
						$this->uid);
					if(isset($res[0])){
						return array("id"=>$res[0]["id"],"email"=>$res[0]["email"]);//$res[0];
					}else{
						return array('error' => 'user not found' );;
					}
				}
			}
		}

		function signup($email, $pass, $type,$company_id,$project_id){
			//pre($profile);
			if($this->searchEmail($email)){
				return array('error' => 'account exists');
			}else{
				$username = (isset($profile->username)) ? $profile->username : null;
				$res = query("INSERT INTO `tbl_users` (`email`,`password`) VALUES (?,?)",
					$email,$pass);
				$this->uid = $res;
				$this->email = $email;
				$res = query("INSERT INTO `tbl_people` (`user_id`,`type`) VALUES (?,?)",
					$this->uid,$type); 
				//TODO: add profile and handle null values

				//handle com
				if ($company_id!=NULL) {
					$res = query("INSERT INTO `tbl_company_admins` (`user_id`,`company_id`) VALUES (?,?)",
					$this->uid,$company_id);	
				}

				//handle pro
				if ($company_id!=NULL) {
					$res = query("INSERT INTO `tbl_project_people` (`user_id`,`project_id`,`company_id`) 
						VALUES (?,?,?)",
					$this->uid,$project_id,$company_id);	
				}
				return $this->getUser();
			}//
		}

		function signin($email, $pass ,$api_access){
			//pre($profile);
			if(!$this->searchEmail($email)){
				return array('error' => 'invalid email or password');
			}else{
				$username = (isset($profile->username)) ? $profile->username : null;
				$res = query("SELECT * FROM `tbl_users` WHERE `email`=? ",$email);
				$this->email = $email;
				if($res[0]['password'] == $pass){
					$this->uid = $res[0]['id'];
					//reverify api key
					if($api_access->verified == null){
						$api_access->verifyKey();
					}
					if(!$api_access->verified){
						return array('error' => 'invalid api key');
					}
					//generate token
					$token = new Token();
					$t = $token->generateToken($this->uid,$api_access);
					return array('access_token' => $t, 'credentials' => $this->getUser());
				}
				//TODO: add profile and handle null values
				return array('error' => 'invalid email or password');
			}
		}

		static function searchEmail($email){
			$res = query("SELECT * FROM `tbl_users` WHERE `email` = ?",$email);
			if($res == null){
				return false;
			}
			if(isset($res[1])){
				return array('error' => 'account error, contact admin');
			}
			return true;
		}
	}
?>