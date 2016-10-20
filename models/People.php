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
				$res = query("SELECT tbl_people.id,`fName`,`lName`,tbl_people.user_id,`phone_no`,`email`,`type_name` 
				FROM `tbl_people`
				INNER JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id
				LEFT JOIN `tbl_project_people` ON tbl_users.id = tbl_project_people.user_id
				LEFT JOIN `tbl_projects` ON tbl_projects.id = tbl_project_people.project_id 
				LEFT JOIN tbl_people_type ON tbl_people.type=tbl_people_type.id
				 	WHERE  tbl_people.user_id= ?",$this->user_id);

				// get persons projects
				$res1=query("SELECT `project_id`,`name` FROM `tbl_people`
				INNER JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id
				LEFT JOIN `tbl_project_people` ON tbl_users.id = tbl_project_people.user_id
				LEFT JOIN `tbl_projects` ON tbl_projects.id = tbl_project_people.project_id 
				LEFT JOIN tbl_people_type ON tbl_people.type=tbl_people_type.id 
				WHERE  tbl_people.user_id= ?",$this->user_id);
				
				
				if(isset($res[0])){
					if(count($res1) != 0 && !array_key_exists('error', $res1)){
						foreach ($res1 as $project_key => $project) {
							//pre($user);
							$res[0]['projects'][] = $project['name']; 
						}
						return $res[0];
					}


					
				}else{
					return array('error' => 'Person not found' );
				}
			}
		}

		function all(){
			$res= query("SELECT tbl_people.id,`fName`,`lName`,tbl_people.user_id,`phone_no`,`email`,`type_name`, `project_id`, `name` FROM `tbl_people`
				LEFT JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id
				LEFT JOIN `tbl_project_people` ON tbl_users.id = tbl_project_people.user_id
				LEFT JOIN `tbl_projects` ON tbl_projects.id = tbl_project_people.project_id 
				LEFT JOIN tbl_people_type ON tbl_people.type=tbl_people_type.id ");
				

				return $res;
				// if(isset($res)){
				// 	foreach ($res as $person_key) {
				// 		$res1=query("SELECT `project_id`,`name` FROM `tbl_people`
				// 		INNER JOIN `tbl_users` ON tbl_users.id = tbl_people.user_id
				// 		LEFT JOIN `tbl_project_people` ON tbl_users.id = tbl_project_people.user_id
				// 		LEFT JOIN `tbl_projects` ON tbl_projects.id = tbl_project_people.project_id 
				// 		LEFT JOIN tbl_people_type ON tbl_people.type=tbl_people_type.id 
				// 		WHERE  tbl_people.user_id= ?",$res[0]['id']);

				// 		if(count($res1) != 0 && !array_key_exists('error', $res1)){
							
				// 			foreach ($res1 as $project_key => $project) {
				// 				pre($user);
				// 				$res[0]['projects'][] = $project['name']; 
				// 			}
				// 		}
				// 		return $res;
				// 	}
				// }else{
				// 	return array('error' => 'Person not found' );
				// }
		}


		function get_person($user_id){
			$res = query("SELECT `id`,`fName`,`lName`,`phone_no`,`type`, `user_id` FROM `tbl_people` WHERE `user_id` = ?",$user_id);
			if ($res==null) {
				return array('error' => 'person does not exist');
			}else{
				$this->user_id = $res[0]["user_id"];				
				
				return $this->getPerson();
			
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
				
				return array($this->getPerson());
				
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
			
				return array($this->getPerson());
				
			}
		}

		function delete_person($user_id){
			$res = query("SELECT `id`,`fName`,`lName`,`phone_no`,`type`,`user_id` FROM `tbl_people` WHERE `user_id`=?",
				$user_id);
			if ($res==null) {
				return array('error' => 'person does not exist');
			}else{
				$this->user_id = $res[0]["user_id"];
				query("DELETE FROM `tbl_people` WHERE `user_id`=?",
					$user_id);
				
				return array('person' => $res[0]);
				
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