<?php
	class Companies
	{
		/*private $uid = null;
		private $name = "";
		private $email = null;*/
		private $name = "";
		
		function __construct(){
		}

		function getCompany(){
			//pre($this->email);
			if(!$this->name == null){	
				$res = query("SELECT `id`,`name`,`description` FROM `tbl_companies` WHERE `name` = ?",
					$this->name);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Company not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT `id`,`name`,`description` FROM `tbl_companies`");
			return $res;
		}

		function add_company($name, $description){
			//pre($profile);
			if($this->searchName($name)){
				return array('error' => 'company already exists');
			}else{
					//$username = (isset($profile->username)) ? $profile->username : null;
					$res = query("INSERT INTO `tbl_companies` (`name`,`description`) VALUES (?,?)",
						$name,$description);
					$this->name = $name;				
					/*//regenerate token expiry key
					$token = new Token();
					$t = $token->generateToken($this->uid,$api_access);*/
					return array('company' => $this->getCompany());
				}
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
		}

		function get_company($id){
			//$username = (isset($profile->username)) ? $profile->username : null;
			$res = query("SELECT `id`,`name`,`description` FROM `tbl_companies` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'company does not exist');
			}else{
				$this->name = $res[0]["name"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getCompany();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function update_company($id,$name,$description){
			//$username = (isset($profile->username)) ? $profile->username : null;
			$res = query("SELECT `id`,`name`,`description` FROM `tbl_companies` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'company does not exist');
			}else{
				$this->name = $res[0]["name"];
				query("UPDATE `tbl_companies` SET `name`=?, `description`=? WHERE `id`=?",
					$name,$description,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array('company' => $this->getCompany());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function delete_company($id){
			//$username = (isset($profile->username)) ? $profile->username : null;
			$res = query("SELECT `id`,`name`,`description` FROM `tbl_companies` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'company does not exist');
			}else{
				$this->name = $res[0]["name"];
				query("DELETE FROM `tbl_companies` WHERE `id`=?",
					$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array('company' => $res[0]);
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}


		static function searchName($name){
			$res = query("SELECT * FROM `tbl_companies` WHERE `name` = ?",$name);
			if($res == null){
				return false;
			}
			if(isset($res[1])){
				return array('error' => 'company already exists');
			}
			return true;
		}
	}
?>