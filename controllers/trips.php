<?php 
	/**
	* 
	*/
	class TripsController extends Controller
	{
		
		private $trips;

		function __construct($method, $verb, $args, $file)
		{
			$this->trips = new Trips();

			parent::__construct($method, $verb, $args, $file);
		}
		function TripsController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all trips
					return $this->trips->all();
				}else{
					//get a specific trip by trip_id
					return $this->trips->get_trip($this->args[0]);
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
					if (!$this->contains(array('trip_creator','start_coordinate','end_coordinate'))) {
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
									if (isset($array_value->trip_id)) {
										$trip_id=$array_value->trip_id;
									}*/
									$res[]=$this->trips->add_trip($array_value->trip_creator,$array_value->start_coordinate,$array_value->end_coordinate);
								}

								return $res;
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
						$payload_array=array();
						$res=array();
						if (!is_array($this->payload)) {
							$payload_array[]=$this->payload;	
						}else{
							$payload_array=$this->payload;
						}
					foreach ($payload_array as $array_key => $array_value) {
							$id=NULL;
							
							if (isset($array_value->company_id)) {
								$company_id=$array_value->company_id;
							}
							if (isset($array_value->trip_id)) {
								$trip_id=$array_value->trip_id;
							}
							$res[]=$this->trips->update_trip($array_value->id,$array_value->trip,$array_value->make_id);
						}

						return $res;
					}else{
						if (!$this->contains(array('trip','make_id'))) {
							//return resposne constructed by contains()
							return $this->response;
						}else{
							return $this->trips->update_trip($this->args[0],$this->payload->trip,$this->payload->make_id);
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
					//get all trips
					return array('error' => 'please choose a trip to delete');
				}else{
						return $this->trips->delete_trip($this->args[0]);
					}					
				}
			}
	}

?>