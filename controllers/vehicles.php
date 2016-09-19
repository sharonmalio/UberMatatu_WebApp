<?php 
	/**
	* 
	*/
	class VehiclesController extends Controller
	{
		
		private $vehicles;

		function __construct($method, $verb, $args, $file, $headers)
		{
			$this->vehicles = new Vehicles();

			parent::__construct($method, $verb, $args, $file, $headers);
		}
		function VehiclesController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all vehicles
					//return $this->token->getUser();
					return $this->vehicles->all();
				}else{
					//get a specific vehicle by id
					return $this->vehicles->get_vehicle($this->args[0]);
				}
			}
		}

		function POST(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				//add vehicle
				//return print_r($this->payload->model_id);
				if (!$this->contains(array('plate','model_id','capacity'))) {
						//return resposne constructed by contains()
						return $this->response;
				}else{
					return $this->vehicles->add_vehicle($this->payload->plate,
						$this->payload->model_id,$this->payload->capacity);
				}
			}
		}

		function PUT(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all vehicles
					return array('error' => 'please choose a vehicle to update');
				}else{
					if (!$this->contains(array('plate','model_id'))) {
						//return resposne constructed by contains()
						return $this->response;
					}else{
						return $this->vehicles->update_vehicle($this->args[0],$this->payload->plate,
							$this->payload->model_id);
					}					
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
					//get all vehicles
					return array('error' => 'please choose a vehicle to delete');
				}else{
						return $this->vehicles->delete_vehicle($this->args[0]);
					}					
				}
			}
	}

?>