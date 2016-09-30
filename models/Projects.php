<?php
	class Projects
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $name = "";
		
		function __construct(){
		}

		function getProject(){
			//pre($this->email);
			if($this->name != null){	
				$res = query("SELECT `id`,`name`,`description`,`company_id`
					FROM `tbl_projects`
				 	WHERE  `name`= ?",$this->name);
				if(isset($res[0])){
					return $res;
				}else{
					return array('error' => 'Project not found' );
				}
			}
		}

		function all($company_head){
			//pre($profile);
			$res = query("SELECT * FROM `tbl_company_admins` WHERE `user_id` = ?",$company_head);
			$company = $res[0]["company_id"];

			$res = query("SELECT id,`name`,`description`,`name`,`company_id`
				FROM `tbl_projects` WHERE `company_id` = ?",$company);
			return $res;
		}

		function add_project($name, $description, $company_head){


			$res = query("SELECT * FROM `tbl_company_admins` WHERE `user_id` = ?",$company_head);
			$company = $res[0]["company_id"];
			//pre($profile);
			if($this->searchName($name)){
				return array('error' => 'project already exists');
			}else{
					//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
					$res = query("INSERT INTO `tbl_projects` (`name`,`description`,`company_id`) 
						VALUES (?,?,?)",$name, $description, $company);
					$this->name = $name;				
					//regenerate token expiry key
					/*$token = new Token();
					$t = $token->generateToken($this->uid,$api_access);*/
					return $this->getProject();
				}
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
		}

		function my_projects($project_person){

			$res = query("SELECT tbl_projects.id,`name`, `description`, `company_id` FROM `tbl_project_people` INNER JOIN tbl_projects ON tbl_project_people.project_id = tbl_projects.id WHERE `user_id` = ?",$project_person);
			
			//$res = query("SELECT `id`,`name`,`description`,`company_id` FROM `tbl_projects` WHERE `id` = ?",$project_id);
			return $res;

		}

		function project_trips($project_manager){

			$res = query("SELECT * FROM `tbl_project_people` WHERE `user_id` = ?",$project_manager);
			$project_id = $res[0]["project_id"];
			$res = query("SELECT * FROM `tbl_project_people`
			INNER JOIN `tbl_people` ON tbl_project_people.user_id = tbl_people.user_id 
			INNER JOIN `tbl_trips` ON tbl_trips.trip_creator = tbl_people.user_id
			 WHERE tbl_project_people.project_id = ?",$project_id);

			if($res == null){
				return array('error' => 'You are not included in this trip');
			} 
			else{
				return $res;
			}
	
		}

//functional error here
		function project_staff($project_manager){
			$res = query("SELECT * FROM `tbl_project_people` WHERE `user_id` = ?",$project_manager);
			$project_id = $res[0]["project_id"];

			$res= query("SELECT tbl_people.user_id,`name`,`fName`,`lName`,`phone_no`,`email`,tbl_projects.id AS 'project_id' FROM `tbl_project_people`
			INNER JOIN `tbl_people` ON tbl_project_people.user_id = tbl_people.user_id
			INNER JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id
			INNER JOIN `tbl_projects` ON tbl_projects.id = tbl_project_people.project_id 
			WHERE project_id = ? ",$project_id );

			return $res;


		}
		
		function get_project($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`name`,`description`,`company_id` FROM `tbl_projects` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'project does not exist');
			}else{
				$this->name = $res[0]["name"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getProject();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		// function self_update_project($name, $name, $description, $company_id){
		// 	$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
		// 	$res = query("SELECT `id`,`name`,`description`,`company_id` FROM `tbl_projects` WHERE `id`=?",
		// 		$name);
		// 	if ($res==null) {
		// 		return array('error' => 'project does not exist');
		// 	}else{
		// 		return $type;
		// 		$this->name = $res[0]["name"];
		// 		query("UPDATE `tbl_projects` SET `name`=?,`description`=?,`company_id`=?,`type`=? WHERE `id`=?",
		// 			$name, $description, $company_id, $type,$name);
		// 		regenerate token expiry key
		// 		$token = new Token();
		// 		$t = $token->generateToken($this->uid,$api_access);
		// 		return array($this->getProject());
		// 		TODO: add profile and handle null values
		// 		return array('error' => 'invalid email or password');
		// 	}
		// }

		function update_project($id,$name, $description, $company_id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`name`,`description`,`company_id` FROM `tbl_projects` WHERE `id`=?",$id);
			if ($res==null) {
				return array('error' => 'project does not exist');
			}else{
				$this->name = $res[0]["name"];
				query("UPDATE `tbl_projects` SET `name`=?,`description`=?,`company_id`=? WHERE `id`=?",
					$name, $description, $company_id,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getProject());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function delete_project($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`name`,`description`,`company_id` FROM `tbl_projects` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'project does not exist');
			}else{
				$this->name = $res[0]["name"];
				query("DELETE FROM `tbl_projects` WHERE `id`=?",
					$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array('project' => $res[0]);
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}


		static function searchName($name){
			$res = query("SELECT * FROM `tbl_projects` WHERE `name` = ?",$name);
			if($res == null){
				return false;
			}
			if(isset($res[0])){
				return array('error' => 'project already exists');
			}
			return true;
		}
	}
?>