<?php
	class Token
	{
		public $TOKEN_LEN = 12;
		public $token = null;
		public $uid = null;
		private $verified = null;
		
		function __construct($token = null){
			$this->token = $token;
		}
		
		public function generateToken($uid,$api_access){
			//remove similar token
			$num = query("SELECT COUNT(token_id) FROM `tbl_user_tokens` WHERE user_id = ? AND api_access_id = ?",
				$uid,$api_access->api_access_id);
			if(isset($num[0]['COUNT(token_id)']) && $num[0]['COUNT(token_id)']>0){
				query("DELETE FROM `tbl_user_tokens` WHERE user_id = ? AND api_access_id = ?",
				$uid,$api_access->api_access_id);
			}
			//$t = bin2hex(uniqid($this->TOKEN_LEN));
			$t = bin2hex(openssl_random_pseudo_bytes($this->TOKEN_LEN));
			$res = query("INSERT INTO `tbl_user_tokens` (user_id,api_access_id,token) VALUES(?,?,?)",
				$uid,$api_access->api_access_id,$t);
			//var_dump($res);
			$this->token = $t;
			$this->uid = $uid;
			return $this->token;
		}

		public function verifyToken(){
			$r = query("SELECT * FROM `tbl_user_tokens` WHERE `token` = ? ",$this->token);
			//pre($r);
			if(isset($r[0])){
				session_start();
				$_SESSION["token"]=$this->token;
				//pre($_SESSION["ward_admin"]);
				//pre($this->token);
				$this->uid = $r[0]['user_id'];
				return $this->verified = true;
			}
			//pre($r);
			return $this->verified = false;
		}

		public function verifyRefreshToken($key, $origin){
			pre($key);
		}

		public function refreshToken($key, $origin){
			pre($key);
		}

		public function getUser(){
			if($this->verified == null){
				$this->verifyToken();
			}
			if(!$this->verified){
				return null;
			}
			$us = new User($this->uid);
			//get user from db using token
			return $us->getUser();
		}

	}
?>