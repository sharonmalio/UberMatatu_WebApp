<?php
	class Models
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $model = "";
		
		function __construct(){
		}

		function getModel(){
			//pre($this->email);
			if($this->model != null){	
				$res = query("SELECT tbl_vehicle_model.id as model_id,`model`,`make_id`,`make`
					FROM `tbl_vehicle_model`
					LEFT JOIN `tbl_vehicle_make` ON `make_id`=tbl_vehicle_make.id
				 	WHERE  `model`= ?",$this->model);
				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Model not found' );
				}
			}
		}

		function all(){
			//pre($profile);
			$res = query("SELECT tbl_vehicle_model.id as model_id,`model`,`make`,`make_id`
					FROM `tbl_vehicle_model`
					LEFT JOIN `tbl_vehicle_make` ON `make_id`=tbl_vehicle_make.id");
			return $res;
		}

		function add_model($model, $make_id){
			//pre($profile);
			if($this->searchName($model)){
				return array('error' => 'model already exists');
			}else{
					//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
					$res = query("INSERT INTO `tbl_vehicle_model` (`model`,`make_id`) 
						VALUES (?,?)",$model, $make_id);
					$this->model = $model;				
					//regenerate token expiry key
					/*$token = new Token();
					$t = $token->generateToken($this->uid,$api_access);*/
					return $this->getModel();
				}
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
		}

		function get_model($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`model`,`make_id` FROM `tbl_vehicle_model` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'model does not exist');
			}else{
				$this->model = $res[0]["model"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getModel();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function update_model($id,$model,$make_id){
			//return $id;
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`model`,`make_id` FROM `tbl_vehicle_model` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'model does not exist');
			}else{
				$this->model = $res[0]["model"];
				$res=query("UPDATE `tbl_vehicle_model` SET `model`=?,`make_id`=? WHERE `id`=?",
					$model,$make_id,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getModel());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function delete_model($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`model`,`make_id` FROM `tbl_vehicle_model` WHERE `id`=?",
				$id);
			if ($res==null) {
				return array('error' => 'model does not exist');
			}else{
				$this->name = $res[0]["model"];
				query("DELETE FROM `tbl_vehicle_model` WHERE `id`=?",
					$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array('model' => $res[0]);
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}


		static function searchName($model){
			$res = query("SELECT * FROM `tbl_vehicle_model` WHERE `model` = ?",$model);
			if($res == null){
				return false;
			}
			if(isset($res[0])){
				return array('error' => 'model already exists');
			}
			return true;
		}
	}
?>