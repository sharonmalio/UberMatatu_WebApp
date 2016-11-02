<?php
	class Payments
	{
		/*private $uid = null;
		private $plate = "";
		private $email = null;*/
		private $id = "";
		
		function __construct(){
		}

		function getTrip(){
			//pre($this->email);
			if($this->payment != null){	
				$res = query("SELECT tbl_trips.id,`start_mileage`,`end_mileage`,`start_coordinate`,`start_location`,`end_coordinate`,`end_location`,`trip_date`,`trip_time`,`date`,`allocation_id`,`start_time`,`stop_time`,`trip_creator`,`fName`, `lName`,`phone_no`,`project_id`,`name` AS Project_name,`status`,`approval`,`fare_estimate`,`actual_fare` FROM `tbl_trips`
					INNER JOIN `tbl_people` ON tbl_people.user_id = tbl_trips.trip_creator
					LEFT JOIN `tbl_trip_approval_status` ON tbl_trip_approval_status.id = tbl_trips.approval
					LEFT JOIN `tbl_projects` ON tbl_projects.id = tbl_trips.project_id  
				
				 	WHERE  tbl_trips.id= ?",$this->payment);

				if(isset($res[0])){
					return $res[0];
				}else{
					return array('error' => 'Trip not found' );
				}
			}
		}

		
		function all(){
			$res = query("SELECT tbl_trips.id,`start_coordinate`,`start_location`,`end_coordinate`,`end_location`,`trip_date`,`trip_time`,`date`,`allocation_id`,`plate`, `make`,`model`,`start_time`,`stop_time`,`trip_creator`,`start_coordinate`,`start_location`,`end_coordinate`,`end_location`,`project_id`,`name` AS project_name,`status`,`approval`,`fare_estimate`,`actual_fare`,transaction_id FROM `tbl_trips`
				LEFT JOIN `tbl_allocation` ON tbl_trips.allocation_id = tbl_allocation.id
				LEFT JOIN `tbl_vehicles` ON tbl_vehicles.id = tbl_allocation.vehicle_id
				LEFT JOIN `tbl_vehicle_model` ON tbl_vehicle_model.id = tbl_vehicles.model_id 
				LEFT JOIN `tbl_vehicle_make` ON tbl_vehicle_model.make_id = tbl_vehicle_make.id
				LEFT JOIN `tbl_trip_approval_status` ON tbl_trip_approval_status.id = tbl_trips.approval
				LEFT JOIN `tbl_projects` ON tbl_projects.id = tbl_trips.project_id  ORDER BY transaction_id
					");
			$car = ["allocation_id"];

			foreach ($res as $trip_key => $trip) {
				if ($trip['allocation_id'] != null) {
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
				}
				else{
					$res2[]=$trip;
				}
				
			}

			return $res2;
		}
		function make_payment($trip_id,$payment_method,$transaction_id){
			// if($this->searchName($payment)){
			// 	return array('error' => 'payment already exists');
			// }else{
					$res = query("UPDATE `tbl_trips` SET payment_status = ?, transaction_id = ?, payment_method_id = ?  WHERE id = ?",1,$transaction_id,$payment_method,$trip_id);
					
					$this->payment = $trip_id;	


				
					return $this->getTrip();
				}
				
		//}

		function get_payment($id){
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`payment` FROM `tbl_vehicle_payment` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'payment does not exist');
			}else{
				$this->payment = $res[0]["payment"];				
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return $this->getPayment();
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}

		function update_payment($id,$payment){
			//return $id;
			//$userplate = (isset($profile->userplate)) ? $profile->userplate : null;
			$res = query("SELECT `id`,`payment`FROM `tbl_vehicle_payment` WHERE `id` = ?",$id);
			if ($res==null) {
				return array('error' => 'payment does not exist');
			}else{
				$this->payment = $payment;
				$res=query("UPDATE `tbl_vehicle_payment` SET `payment`=? WHERE `id`=?",
					$payment,$id);
				/*//regenerate token expiry key
				$token = new Token();
				$t = $token->generateToken($this->uid,$api_access);*/
				return array($this->getPayment());
				//TODO: add profile and handle null values
				//return array('error' => 'invalid email or password');
			}
		}




		// static function searchName($payment){
		// 	$res = query("SELECT * FROM `tbl_trip` WHERE `payment` = ?",$payment);
		// 	if($res == null){
		// 		return false;
		// 	}
		// 	if(isset($res[0])){
		// 		return array('error' => 'payment already exists');
		// 	}
		// 	return true;
		// }
	}
?>