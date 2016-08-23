<?php
	class Activity
	{
		private $id;
		private $user_id;
		private $group_id;
		private $type;
		private $description;
		private $title;
		private $start;
		private $end;
		private $admin_group;
		
		function __construct(){

		}
		

		public function getActivity($id){
			$res = query("SELECT * FROM `activities` WHERE `id` = ?",$id)[0];	
			return $res;
		}

		
	}
?>