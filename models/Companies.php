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
					$res = query("INSERT INTO `tbl_companies` (`name`,`description`) VALUES (?,?)",
						$name,$description);
					$this->name = $name;				
					
					return array('company' => $this->getCompany());
				}
		
		}

		function company_trips($company_head){

			$res = query("SELECT * FROM `tbl_company_admins` WHERE `user_id` = ?",$company_head);
			$company = $res[0]["company_id"];
			$res = query("SELECT *  FROM `tbl_projects` 
				LEFT JOIN `tbl_project_people` ON tbl_projects.id = tbl_project_people.project_id
				LEFT JOIN `tbl_trips` ON tbl_project_people.user_id = tbl_trips.trip_creator WHERE `company_id` =? ", $company);

			if($res == null){
				return array('error' => 'You are not a company admin');
			} 
			else{
				return $res;
			}

		}

		function projectmanagers($company_head){
			$res = query("SELECT * FROM `tbl_company_admins` WHERE `user_id` = ?",$company_head);
			$company = $res[0]["company_id"];

			$res = query("SELECT tbl_project_people.user_id,`name`,`fName`,`lName` FROM `tbl_projects`
			INNER JOIN `tbl_project_people` ON tbl_project_people.project_id = tbl_projects.id
			INNER JOIN `tbl_people` ON tbl_project_people.user_id = tbl_people.user_id 
			 WHERE `company_id` = ? AND `type` = ?",$company,3);
			return $res;


					}

		function company_staff($company_head){
			$res = query("SELECT * FROM `tbl_company_admins` WHERE `user_id` = ?",$company_head);
			$company = $res[0]["company_id"];
			

			$res= query("SELECT tbl_project_people.user_id, `name`,`fName`,`lName`,`phone_no`,`email` FROM `tbl_project_people`
			INNER JOIN `tbl_people` ON tbl_project_people.user_id = tbl_people.user_id
			INNER JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id
			INNER JOIN `tbl_projects` ON tbl_projects.id = tbl_project_people.project_id 
			WHERE company_id = ? ",$company );

			return $res;

		}

		function company_project($company_head){
			$res = query("SELECT * FROM `tbl_company_admins` WHERE `user_id` = ?",$company_head);
			$company = $res[0]["company_id"];

			$res = query("SELECT id,`name`,`description`,`company_id`
				FROM `tbl_projects` WHERE `company_id` = ?",$company);
			return $res;
		}
		function get_company($id){
			//$username = (isset($profile->username)) ? $profile->username : null;
			$res = query("SELECT `id`,`name`,`description` FROM `tbl_companies` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'company does not exist');
			}else{
				$this->name = $res[0]["name"];				
				
				return $this->getCompany();
				
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
				
				return array('company' => $this->getCompany());
				
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
			
				return array('company' => $res[0]);
				
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