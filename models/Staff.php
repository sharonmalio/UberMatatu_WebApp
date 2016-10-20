<?php
	class Staff
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $staff = "";
		
		function __construct(){
		}

		function getStaff(){
			//pre($this->email);
			if($this->staff != null){	
				$res = query("SELECT `fName`,`lName`,`phone_no`,`type`,`email`,`name` AS `Company Name` FROM `tbl_people`
					INNER JOIN `tbl_company_admins` ON tbl_company_admins.user_id = tbl_people.user_id 
					INNER JOIN `tbl_companies` ON tbl_companies.id = tbl_company_admins.company_id
					INNER JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id 
					WHERE `type` = 1 AND tbl_people.id = ?",$this->staff);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Staff not found' );
				}
			}
		}

		function get_fellow_staff($staff){
			$res = query("SELECT * FROM `tbl_project_people` WHERE `user_id` = ?",$staff);

			$project = $res[0]["project_id"];

			$res= query("SELECT `email`  FROM `tbl_project_people`
			INNER JOIN `tbl_people` ON tbl_project_people.user_id = tbl_people.user_id
			INNER JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id
			WHERE project_id = ? ",$project );

			return $res[0];

		}

		function all(){
			//pre($profile);
			$res = query("SELECT `fName`,`lName`,`phone_no`,`type`,`email`,`name` AS `Company Name` FROM `tbl_people`
					INNER JOIN `tbl_company_admins` ON tbl_company_admins.user_id = tbl_people.user_id 
					INNER JOIN `tbl_companies` ON tbl_companies.id = tbl_company_admins.company_id
					INNER JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id
			WHERE `type` = 1");
			return $res;
		}

	

		function get_staff($id){
			$res = query("SELECT `id`,`fName`,`lName`,`phone_no`,`type`, `user_id` FROM `tbl_people` WHERE `type` = 1 AND `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'staff does not exist');
			}else{
				$this->staff = $res[0]["id"];				
				
					return $this->getStaff();
				
			}
		}
	}
?>