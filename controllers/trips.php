<?php 
	/**
	* 
	*/
	class TripsController extends Controller
	{	
		
		private $trips;

		function __construct($method, $verb, $args, $file, $headers)
		{
			$this->trips = new Trips();

			parent::__construct($method, $verb, $args, $file, $headers);
		}
		function TripsController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{

				
				if (!$this->args){

					if($this->verb == "mytrips"){
					$trip_creator=$this->token->getUser();

					return $this->trips->get_mytrips($trip_creator['id']);
					
					}else if($this->verb == "user"){
						
						return array('error' => 'please choose a user');
						
					}

					//get all trips
					return $this->trips->all();
				}else{
					if($this->verb == "user"){
						return $this->trips->get_usertrips($this->args[0]);
					}else{	
						//get a specific trip by trip_id
						return $this->trips->get_trip($this->args[0]);
					}
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
					if (!$this->contains(array('start_coordinate','start_location','end_coordinate','end_location','trip_date','trip_time','project_id','fare_estimate'))) {
							//return response constructed by contains()
							return $this->response;
						}else
						{
							$trip_creator=$this->token->getUser();
							$payload_array=array();
							if (!is_array($this->payload)) {
								$array_value=$this->payload;
								$res=$this->trips->add_trip($trip_creator["id"],$array_value->start_coordinate,$array_value->start_location,$array_value->end_coordinate,$array_value->end_location,$array_value->trip_date,$array_value->trip_time,$array_value->project_id,$array_value->fare_estimate);
								if($this->contains(array('group'),false))
								{
									$mGroup = new Grouptrips();
									foreach ($array_value->group as $email_key => $email) {
										$mGroup->add_grouptrip($res['id'],$email);
									}
								}
								$res=$this->trips->get_trip($res['id']);
							}else{
								$res=array();
								$payload_array=$this->payload;
								foreach ($payload_array as $array_key => $array_value) {
									$res[]=$this->trips->add_trip($trip_creator["id"],$array_value->start_coordinate,$array_value->start_location,$array_value->end_coordinate,$array_value->end_location,$array_value->trip_date,$array_value->trip_time,$array_value->project_id,$array_value->fare_estimate);
									if($this->contains(array('group'),false))
									{
										$mGroup = new Grouptrips();
										//print_r($res[$array_key]);
										foreach ($array_value->group as $email_key => $email) {
											$mGroup->add_grouptrip($res[$array_key]['id'],$email);
										}
										$gtrips = $mGroup->get_grouptrip($res[$array_key]['id']);
										foreach ($gtrips as $gtrip_key => $user) {
											//pre($user);
											$res[$array_key]['group'][] = $user['email']; 
										}
									}
								}
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
					if($this->verb == "decide"){
							if (!$this->contains(array('decision','trip_id'))) {
									//return resposne constructed by contains()
									return $this->response;
								}else{
									$trip_creator=$this->token->getUser();
									$payload_array=array();
									if (!is_array($this->payload)) {
										$res=$this->trips->approve_trip($this->payload->decision,$this->payload->trip_id);	
									}else{
										$payload_array=$this->payload;
										$res=array();
										foreach ($payload_array as $array_key => $array_value) {
											$res[]=$this->trips->approve_trip($array_value->decision,$array_value->trip_id);
										}
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
										if (!is_array($this->payload)) {
											$res=$this->trips->start_trip($this->payload->id,$this->payload->start_mileage);	
										}else{
											$payload_array=$this->payload;
											$res=array();
											foreach ($payload_array as $array_key => $array_value) {
												$res[]=$this->trips->start_trip($array_value->id,$array_value->start_mileage);
											}
										}

									return $res;
								}				

							
						}
					if($this->verb == "stop"){
							if (!$this->contains(array('id','end_mileage','actual_fare'))) {
									//return resposne constructed by contains()
									return $this->response;
							}else{
								$trip_creator=$this->token->getUser();
								$payload_array=array();
								if (!is_array($this->payload)) {
									$res=$this->trips->stop_trip($this->payload->id,$this->payload->end_mileage,$this->payload->actual_fare);
								}else{
									$res=array();
									$payload_array=$this->payload;
									foreach ($payload_array as $array_key => $array_value) {
										$res[]=$this->trips->stop_trip($array_value->id,$array_value->end_mileage,$array_value->actual_fare);
									}
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

					if($this->verb == "cancel"){
						if(!$this->contains(array('trip_id'))){

							return $this->response;
						}else{
							$trip_creator=$this->token->getUser();
							$payload_array=array();
							if (!is_array($this->payload)) {
								$res=$this->trips->cancel_trip($this->payload->trip_id);
							}else{
								$res=array();
								$payload_array=$this->payload;
								foreach ($payload_array as $array_key => $array_value) {	
									$res[]=$this->trips->cancel_trip($array_value->trip_id);
								}
							}
							return $res;
						}
					}

					if($this->verb == "deny"){
						if(!$this->contains(array('trip_id'))){

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
								
								$res[]=$this->trips->deny_trip($array_value->trip_id);
								}

							return $res;

						}
					}
					if($this->verb == "add_members"){
						if(!$this->contains(array('trip_id','email'))){
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
								
								$res[]=$this->trips->add_members($array_value->trip_id,$array_value->email);
								}

							return $res;						}
					}
					

					if (!$this->contains(array('id',`start_coordinate`,`start_location`,`end_coordinate`,`end_location`,'trip_date','trip_time','project_id'))) {
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
									$array_value->start_coordinate,$array_value->start_location,$array_value->end_coordinate,$$array_value->end_location,$array_value->trip_date,$array_value->trip_time,$array_value->project_id);
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
				if($this->verb == 'remove_members'){
						if ($this->args){
							return $this->trips->remove_member($this->args[0]);
							}
					}
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