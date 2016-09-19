<?php 
	/**
	* 
	*/
	class DriversController extends Controller
	{
		
		private $drivers;

		function __construct($method, $verb, $args, $file, $headers)
		{
			$this->drivers = new Drivers();

			parent::__construct($method, $verb, $args, $file, $headers);
		}
		function DriversController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all drivers
					return $this->drivers->all();
				}else{
					//get a specific driver by driver_id
					return $this->drivers->get_driver($this->args[0]);
				}
			}
		}

		// function POST(){
		// 	if (!$this->headerContains(array('authorisation') )) {
		// 		//return response constructed by contains()
		// 		return $this->response;
		// 	}
		// 	else{
		// 		if($this->verb=="many"){
		// 			$driver_creator=$this->token->getUser();
		// 			//return 5;
		// 			if (!$this->contains(array('start_coordinate','end_coordinate'))) {
		// 					//return response constructed by contains()
		// 					return $this->response;
		// 				}else{
		// 						$payload_array=array();
		// 						$res=array();
		// 						if (!is_array($this->payload)) {
		// 							$payload_array[]=$this->payload;	
		// 						}else{
		// 							$payload_array=$this->payload;
		// 						}
		// 						foreach ($payload_array as $array_key => $array_value) {
		// 							/*if (isset($array_value->company_id)) {
		// 								$company_id=$array_value->company_id;
		// 							}
		// 							if (isset($array_value->driver_id)) {
		// 								$driver_id=$array_value->driver_id;
		// 							}*/
									
		// 						}

		// 						return $res;
		// 				}	
					
		// 		}
		// 		else{
		// 			$driver_creator=$this->token->getUser();
		// 			//return 5;
		// 			if (!$this->contains(array('start_coordinate','end_coordinate'))) {
		// 					//return response constructed by contains()
		// 					return $this->response;
		// 				}else{
		// 						$payload_array=array();
		// 						$res=array();
		// 						if (!is_array($this->payload)) {
		// 							$payload_array[]=$this->payload;	
		// 						}else{
		// 							$payload_array=$this->payload;
		// 						}
		// 						foreach ($payload_array as $array_key => $array_value) {
		// 							/*if (isset($array_value->company_id)) {
		// 								$company_id=$array_value->company_id;
		// 							}
		// 							if (isset($array_value->driver_id)) {
		// 								$driver_id=$array_value->driver_id;
		// 							}*/
		// 							$res[]=$this->drivers->add_driver($driver_creator["id"],$array_value->start_coordinate,$array_value->end_coordinate);
		// 						}

		// 						return $res;
		// 				}	
		// 		}
		// 	}
		// }

		// function PUT(){
		// 	if (!$this->headerContains(array('authorisation') )) {
		// 		//return response constructed by contains()
		// 		return $this->response;
		// 	}
		// 	else{


				
		// 			if (!$this->args) {
		// 				$payload_array=array();
		// 				$res=array();
		// 				if (!is_array($this->payload)) {
		// 					$payload_array[]=$this->payload;	
		// 				}else{
		// 					$payload_array=$this->payload;
		// 				}
		// 			foreach ($payload_array as $array_key => $array_value) {
		// 					$id=NULL;
							
		// 					if (isset($array_value->company_id)) {
		// 						$company_id=$array_value->company_id;
		// 					}
		// 					if (isset($array_value->driver_id)) {
		// 						$driver_id=$array_value->driver_id;
		// 					}
		// 					$res[]=$this->drivers->update_driver($array_value->id,$array_value->driver,$array_value->make_id);
		// 				}

		// 				return $res;
		// 			}else{
		// 				if (!$this->contains(array('driver','make_id'))) {
		// 					//return resposne constructed by contains()
		// 					return $this->response;
		// 				}else{
		// 					return $this->drivers->update_driver($this->args[0],$this->payload->driver,$this->payload->make_id);
		// 				}					
		// 			}
		// 		}
		// 	}
		

		// function DELETE(){
		// 	if (!$this->headerContains(array('authorisation') )) {
		// 		//return response constructed by contains()
		// 		return $this->response;
		// 	}
		// 	else{
		// 		if (!$this->args) {
		// 			//get all drivers
		// 			return array('error' => 'please choose a driver to delete');
		// 		}else{
		// 				return $this->drivers->delete_driver($this->args[0]);
		// 			}					
		// 		}
		// 	}
	}

?>