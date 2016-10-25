<?php
	class Operationmanagers
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $operationmanager = "";
		
		function __construct(){
		}

		function getOperationmanager(){
			//pre($this->email);
			if($this->operationmanager != null){	
				$res = query("SELECT tbl_people.user_id,`fName`,`lName`,`phone_no`,`type`,`email`,`name`  FROM `tbl_people`
					INNER JOIN `tbl_company_admins` ON tbl_company_admins.user_id = tbl_people.user_id 
					INNER JOIN `tbl_companies` ON tbl_companies.id = tbl_company_admins.company_id
					INNER JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id 
					WHERE `type` = 1 AND tbl_people.id = ?",$this->operationmanager);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Operationmanager not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT tbl_people.user_id,`fName`,`lName`,`phone_no`,`type`,`email`,`name` FROM `tbl_people`
					INNER JOIN `tbl_company_admins` ON tbl_company_admins.user_id = tbl_people.user_id 
					INNER JOIN `tbl_companies` ON tbl_companies.id = tbl_company_admins.company_id
					INNER JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id
			WHERE `type` = 1");
			return $res;
		}

	

		function get_operationmanager($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`fName`,`lName`,`phone_no`,`type`, `user_id` FROM `tbl_people` WHERE `type` = 1 AND `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'operationmanager does not exist');
			}else{
				$this->operationmanager = $res[0]["id"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
					return $this->getOperationmanager();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}
	}
?>