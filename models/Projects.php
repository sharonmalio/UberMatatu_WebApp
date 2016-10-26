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
					return $res[0];
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
			if($this->searchName($name)){
				return array('error' => 'project already exists');
			}else{
					
					$res = query("INSERT INTO `tbl_projects` (`name`,`description`,`company_id`) 
						VALUES (?,?,?)",$name, $description, $company);
					$this->name = $name;				
					
					return $this->getProject();
				}
				
		}

		function my_projects($project_person){

			$res = query("SELECT tbl_projects.id,`name`, `description`, `company_id` FROM `tbl_project_people` INNER JOIN tbl_projects ON tbl_project_people.project_id = tbl_projects.id WHERE `user_id` = ?",$project_person);
			
			//$res = query("SELECT `id`,`name`,`description`,`company_id` FROM `tbl_projects` WHERE `id` = ?",$project_id);
			return $res;

		}

		function project_trips($project_manager){

			$res = query("SELECT * FROM `tbl_project_people` WHERE `user_id` = ?",$project_manager);
			$project_id = $res[0]["project_id"];
			$res = query("SELECT  tbl_trips.id as trip_id ,`start_coordinate`,start_location,end_coordinate,end_location, trip_date,trip_time, `date`,`trip_creator`,`fName`,`lName`, `phone_no`, `email`,tbl_trips.project_id,`name` AS project_name, `approval`,`status`, fare_estimate,actual_fare
			 FROM `tbl_project_people` 
			INNER JOIN `tbl_people` ON tbl_project_people.user_id = tbl_people.user_id 
			INNER JOIN `tbl_trips` ON tbl_trips.trip_creator = tbl_people.user_id
			LEFT JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id
			LEFT JOIN `tbl_trip_approval_status` ON tbl_trip_approval_status.id = tbl_trips.approval
			LEFT JOIN `tbl_projects` ON tbl_projects.id = tbl_trips.project_id 
			 WHERE tbl_project_people.project_id = ? ",$project_id);

			if($res == null){
				return array('error'=>'No trips for this project');
			} 
			else{
				return $res;
			}
	
		}

		function project_staff($project_manager){
			$res = query("SELECT * FROM `tbl_project_people` WHERE `user_id` = ?",$project_manager);
			$project_id = $res[0]["project_id"];

			$res= query("SELECT tbl_people.user_id,`name`,`fName`,`lName`,`phone_no`,`email`,tbl_projects.id AS 'project_id' FROM `tbl_project_people`
			LEFT JOIN `tbl_people` ON tbl_project_people.user_id = tbl_people.user_id
			LEFT JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id
			LEFT JOIN `tbl_projects` ON tbl_projects.id = tbl_project_people.project_id 
			WHERE project_id = ? AND type = ?",$project_id, 5 );

			return $res;


		}
		
		function get_project($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`name`,`description`,`company_id` FROM `tbl_projects` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'project does not exist');
			}else{
				$this->name = $res[0]["name"];				
				
				return $this->getProject();
			
			}
		}

	

		function update_project($id,$name, $description){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`name`,`description`FROM `tbl_projects` WHERE `id`=?",$id);
			if ($res==null) {
				return array('error' => 'project does not exist');
			}else{
				$this->name = $res[0]["name"];
				query("UPDATE `tbl_projects` SET `name`=?,`description`=? WHERE `id`=?",
					$name, $description,$id);
			
				return array($this->getProject());
			
			}
		}

		function delete_project($id){
			$res = query("SELECT `id`,`name`,`description`,`company_id` FROM `tbl_projects` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'project does not exist');
			}else{
				$this->name = $res[0]["name"];
				query("DELETE FROM `tbl_projects` WHERE `id`=?",
					$id);
				
				return array('project' => $res[0]);
				
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