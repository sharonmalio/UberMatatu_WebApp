<?php 
	/**
	* 
	*/
	class AllocationsController extends Controller
	{
		
		private $allocations;

		function __construct($method, $verb, $args, $file)
		{
			$this->allocations = new Allocations();

			parent::__construct($method, $verb, $args, $file);
		}
		function AllocationsController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all allocations
					return $this->allocations->all();
				}else{
					//get a specific model by model_id
					return $this->allocations->get_allocation($this->args[0]);
				}
			}
		}

		function POST(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
					//return 5;
					if (!$this->contains(array('vehicle_id','driver_id','start_milage'))) {
							//return response constructed by contains()
							return $this->response;
						}else{
								$payload_array=array();
								$res=array();
								if (!is_array($this->payload)) {
									$payload_array[]=$this->payload;	
								}else{
									$payload_array=$this->payload;
								}
								foreach ($payload_array as $array_key => $array_value) {
									/*if (isset($array_value->company_id)) {
										$company_id=$array_value->company_id;
									}
									if (isset($array_value->model_id)) {
										$model_id=$array_value->model_id;
									}*/
									$res[]=$this->allocations->add_allocation($array_value->vehicle_id,$array_value->driver_id,$array_value->start_milage);
								}

								return $res;
						}	
			}
		}

		// function PUT(){
		// 	if (!$this->headerContains(array('authorisation') )) {
		// 		//return response constructed by contains()
		// 		return $this->response;
		// 	}
		// 	else{
				
		// 			if (!$this->contains(array('return_milage'))) {
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
		// 							if (isset($array_value->company_id)) {
		// 								$company_id=$array_value->company_id;
		// 							}
		// 							if (isset($array_value->model_id)) {
		// 								$model_id=$array_value->model_id;
		// 							}
		// 							$res[]=$this->allocations->update_allocation($array_value->return_milage);
		// 						}

		// 						return $res;
		// 				}
		// 		}
		// 	}
		function PUT(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				
					
					if (!$this->contains(array('id','return_milage'))) {
						//return resposne constructed by contains()
						return $this->response;
					}else{
						return $this->allocations->update_allocation($this->payload->id,$this->payload->return_milage);
					}					
				
			}
		}

		function DELETE(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all allocations
					return array('error' => 'please choose a model to delete');
				}else{
						return $this->allocations->delete_model($this->args[0]);
					}					
				}
			}
	}

?>