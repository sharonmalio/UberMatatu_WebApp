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

		function company_trips($company_head){

			$res = query("SELECT * FROM `tbl_company_admins` WHERE `user_id` = ?",$company_head);
			$company = $res[0]["company_id"];
			
			$res = query("SELECT tbl_trips.id AS trip_id,tbl_trips.start_mileage,tbl_trips.end_mileage,date,trip_date,trip_time,allocation_id,start_time,stop_time,trip_creator,start_coordinate,start_location,end_coordinate,end_location,tbl_trips.project_id,approval,status,enroute,fare_estimate,actual_fare,user_id,accepted,tbl_projects.name,company_id,user_level_id
   				FROM `tbl_trips` 
   				LEFT JOIN `tbl_trip_approval_status` ON tbl_trip_approval_status.id = tbl_trips.approval1
				INNER JOIN `tbl_project_people` ON tbl_trips.trip_creator = tbl_project_people.user_id
				INNER JOIN `tbl_projects` ON tbl_project_people.project_id = tbl_projects.id
				INNER JOIN `tbl_companies` ON tbl_projects.company_id = tbl_companies.id
				INNER JOIN `tbl_users` ON tbl_trips.trip_creator = tbl_users.id
				WHERE tbl_companies.id =? ", $company);

			if($res == null){
				return array('error' => 'You are not a company admin');
			} 
			else{
				foreach ($res as $trip_key => $trip) {
					if ($trip['allocation_id'] != null) {
						$res4 = query("SELECT `fName`,`lName`,`phone_no`,`email` FROM tbl_people
							INNER JOIN tbl_users ON tbl_users.id = tbl_people.user_id
							WHERE tbl_people.user_id = ?",$trip['trip_creator']);

						$trip['creator']= $res4[0];

						$res1 = query("SELECT `fName`, `lName`,`phone_no` FROM `tbl_allocation`
						INNER JOIN `tbl_people` ON tbl_allocation.driver_id = tbl_people.user_id
						WHERE   tbl_allocation.id= ?  ",$trip['allocation_id']);
					
					$trip['driver']= $res1[0];

					$res3 = query("SELECT `vehicle_id`,`plate`, `make`,`model` FROM `tbl_allocation`
						INNER JOIN `tbl_vehicles` ON tbl_allocation.vehicle_id = tbl_vehicles.id
						INNER JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id 
						INNER JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id
						WHERE   tbl_allocation.id= ?  ",$trip['allocation_id']);

					$trip['vehicle'] = $res3[0];

						$res2[] = $trip;
					}else{
						$res2[] = $trip;
					}

			}
				return $res2;
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