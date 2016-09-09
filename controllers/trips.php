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
					if($this->verb == "mytrips"){
					$trip_creator=$this->token->getUser();

					return $this->trips->get_mytrips($trip_creator['id']);
					}
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
					if (!$this->contains(array('start_coordinate','end_coordinate','trip_date','trip_time'))) {
							//return response constructed by contains()
							return $this->response;
						}else
						{
							$trip_creator=$this->token->getUser();
							$payload_array=array();
							$res=array();
							if (!is_array($this->payload)) {
								$payload_array[]=$this->payload;	
							}else{
								$payload_array=$this->payload;
							}
							foreach ($payload_array as $array_key => $array_value) {
							
							$res[]=$this->trips->add_trip($trip_creator["id"],$array_value->start_coordinate,$array_value->end_coordinate,$array_value->trip_date,$array_value->trip_time);
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
				
					if($this->verb == "approve"){
							if (!$this->contains(array('id'))) {
									//return resposne constructed by contains()
									return $this->response;
								}else{
									$trip_creator=$this->token->getUser();
									$payload_array=array();
									$res=array();
									if (!is_array($this->payload)) {
										$payload_array[]=$this->payload;	
									}else{
										$payload_array=$this->payload;
									}
									foreach ($payload_array as $array_key => $array_value) {
									
									$res[]=$this->trips->approve_trip($array_value->id);
									}

									return $res;
								}
							}
						
					if($this->verb=="start"){
						
							if (!$this->contains(array('id','start_mileage'))) {
									//return resposne constructed by contains()
									return $this->response;
								}else{
										$trip_creator=$this->token->getUser();
										$payload_array=array();
										$res=array();
										if (!is_array($this->payload)) {
											$payload_array[]=$this->payload;	
										}else{
											$payload_array=$this->payload;
										}
										foreach ($payload_array as $array_key => $array_value) {
										
											$res[]=$this->trips->start_trip($array_value->id,$array_value->start_mileage);
										}

									return $res;
								}				

							
						}
					if($this->verb == "stop"){
							if (!$this->contains(array('id','end_mileage'))) {
									//return resposne constructed by contains()
									return $this->response;
								}else{
									$trip_creator=$this->token->getUser();
								$payload_array=array();
								$res=array();
								if (!is_array($this->payload)) {
									$payload_array[]=$this->payload;	
								}else{
									$payload_array=$this->payload;
								}
								foreach ($payload_array as $array_key => $array_value) {
								
								$res[]=$this->trips->stop_trip($array_value->id,$array_value->end_mileage);
								}

							return $res;
								}
						}

					if($this->verb == "dispatch"){
						if(!$this->contains(array('vehicle_id','trip_id'))){

							return $this->response;
						}else{
								$trip_creator=$this->token->getUser();
								$payload_array=array();
								$res=array();
								if (!is_array($this->payload)) {
									$payload_array[]=$this->payload;	
								}else{
									$payload_array=$this->payload;
								}
								foreach ($payload_array as $array_key => $array_value) {
								
								$res[]=$this->trips->dispatch_vehicle($array_value->vehicle_id,$array_value->trip_id);
								}

							return $res;

						}
					}


						if (!$this->contains(array('id','start_coordinate','end_coordinate','trip_date','trip_time'))) {
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
									
									$res[]=$this->trips->update_trip($array_value->id,
										$array_value->start_coordinate,$array_value->end_coordinate,$array_value->trip_date,$array_value->trip_time);
								}

								return $res;
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