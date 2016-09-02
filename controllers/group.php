<?php 
	/**
	* 
	*/
	class GroupController extends Controller
	{
		
		private $grouptrips;

		function __construct($method, $verb, $args, $file)
		{
			$this->grouptrips = new GroupTrips();

			parent::__construct($method, $verb, $args, $file);
		}
		function GroupController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all grouptrips
					return $this->grouptrips->all();
				}else{
					//get a specific trip by trip_id
					return $this->grouptrips->get_grouptrip($this->args[0]);
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
							if (!$this->contains(array('trip_id', 'user_id'))) {
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
											if (isset($array_value->project_id)) {
												$project_id=$array_value->project_id;
											}*/
											$res[]=$this->grouptrips->add_grouptrip($array_value->trip_id,$array_value->user_id);
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
							
							/*if (isset($array_value->company_id)) {
								$company_id=$array_value->company_id;
							}
							if (isset($array_value->trip_id)) {
								$trip_id=$array_value->trip_id;
							}*/
							$res[]=$this->grouptrips->update_grouptrips($array_value->id,$array_value->trip,$array_value->make_id);
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
					//get all grouptrips
					return array('error' => 'please choose a trip to delete');
				}else{
						return $this->grouptrips->delete_grouptrip($this->args[0]);
					}					
				}
			}
	}

?>