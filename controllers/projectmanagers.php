<?php 
	/**
	* 
	*/
	class ProjectmanagersController extends Controller
	{
		
		private $projectmanagers;

		function __construct($method, $verb, $args, $file)
		{
			$this->projectmanagers = new Projectmanagers();

			parent::__construct($method, $verb, $args, $file);
		}
		function ProjectmanagersController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all projectmanagers
					return $this->projectmanagers->all();
				}else{
					//get a specific projectmanager by projectmanager_id
					return $this->projectmanagers->get_projectmanager($this->args[0]);
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
					if (!$this->contains(array('projectmanager'))) {
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
									if (isset($array_value->projectmanager_id)) {
										$projectmanager_id=$array_value->projectmanager_id;
									}*/
									$res[]=$this->projectmanagers->add_projectmanager($array_value->projectmanager);
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
					if (!$this->contains(array('projectmanager','id'))) {
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
										$res[]=$this->projectmanagers->update_projectmanager($array_value->id,$array_value->projectmanager);
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
				if (!$this->contains(array('id'))) {
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
										$res[]=$this->projectmanagers->delete_projectmanager($array_value->id);
									}

									return $res;
						}					
					}
		}
	}

?>