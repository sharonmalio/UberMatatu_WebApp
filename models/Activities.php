<?php
	class Activities
	{
		private $activities;
		private $uid = null;
		
		function __construct($user_id){
			$this->activities[] = new Activity();
			$this->uid = $user_id;
		}
		

		public function getUserActivities($user_id){
			$res = query("SELECT * FROM `activities` WHERE `user` = ?",$this->uid);	
			return $res;
		}
		public function getAllActivities($user_id){
			$res = query("SELECT * FROM `activities` WHERE `user` = ?",$this->uid);
			//TODO: Add group activities	
			return $res;
		}
		public function addActivity($user_id){
			if($this->user_id != null && $this->group_id != null ){
				//ensure activity is either personal or for group
				$this->group_id = null;
			}
			$res = query("INSERT INTO `activities`(title,description,user_id,group_id,start,stop,type) VALUES ()",$user_id)[0];	

			return $res;
		}
	}
?>