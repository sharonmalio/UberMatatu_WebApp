<?php
	class APIAccess
	{
		public $api_key = null;
		public $api_access_id = null;
		public $verified = null;
		
		function __construct($apikey,$origin = null){
			$this->api_key = $apikey;
		}
		

		public function verifyKey(){
			$r = query("SELECT * FROM `tbl_api_access` WHERE `api_key`= ?",$this->api_key);
			if(!isset($r[0])){
				//Invalid key
				$this->verified = false;
				return $this->verified;
			}elseif(isset($r[1])){
				//"Error authorising key, duplicate key"
				$this->verified = false;
				return $this->verified;
			}else{
				$r = $r[0];
				//pre($r);
				$this->api_access_id = $r['id'];
				$this->verified = true;
				return $this->verified;
			}
		}
		public function getKey(){
			return $this->api_key;
		}
	}
?>