<?php 
	/**
	* 
	*/
	class ProjectsController extends Controller
	{
		
		private $projects;

		function __construct($method, $verb, $args, $file, $headers)
		{
			$this->projects = new Projects();

			parent::__construct($method, $verb, $args, $file, $headers);
		}
		function ProjectsController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					$project_manager=$this->token->getUser();
					if($this->verb == "trips"){
						

						return $this->projects->project_trips($project_manager['id']);
					}

					if($this->verb == "staff"){

						return $this->projects->project_staff($project_manager['id']);
					}
					if($this->verb == "me"){
						$project_person=$this->token->getUser();
						return $this->projects->my_projects($project_person['id']);
					}

					//get all projects
					return $this->projects->all($project_manager['id']);
				}else{
					//get a specific project by user_id
					return $this->projects->get_project($this->args[0]);
				}
			}
		}

		function POST(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
					$project_manager=$this->token->getUser();
					//return 5;
					if (!$this->contains(array('name', 'description'))) {
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
									$res[]=$this->projects->add_project($array_value->name,$array_value->description,$project_manager['id']);
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
				
					if (!$this->contains(array('id','name', 'description'))) {
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
								
									$res[]=$this->projects->update_project($array_value->$array_value->name,
										$array_value->description);
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
					//get all projects
					return array('error' => 'please choose a project to delete');
				}else{
						return $this->projects->delete_project($this->args[0]);
					}					
				}
			}
	}

?>