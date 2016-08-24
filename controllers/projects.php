<?php 
	/**
	* 
	*/
	class ProjectsController extends Controller
	{
		
		private $projects;

		function __construct($method, $verb, $args, $file)
		{
			$this->projects = new Projects();

			parent::__construct($method, $verb, $args, $file);
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
					//get all projects
					return $this->projects->all();
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
					//return 5;
					if (!$this->contains(array('name', 'description','company_id'))) {
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
									$res[]=$this->projects->add_project($array_value->name,$array_value->description,
										$array_value->company_id);
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
				if ($this->verb=="many") {
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
							if (isset($array_value->project_id)) {
								$project_id=$array_value->project_id;
							}
							$res[]=$this->projects->update_project($array_value->id,$array_value->name,$array_value->description,
								$array_value->company_id);
						}

						return $res;	
					
				}else{
					if (!$this->args) {
						//get all projects
						//return array('error' => 'please choose a project to update');
						//return $this->payload;
						return ($this->contains(array('name', 'description','company_id')));
						/*foreach ($this->payload as $key => $value) {
							if (!$this->contains(array('name', 'description','company_id'))) {
								//return response constructed by contains()
								return $this->response;
							}
						}*/
						if (!$this->contains(array('name', 'description','company_id'))) {
							//return response constructed by contains()
							return $this->response;
						}else{
							// $user_id=$this->token->getUser();
							//return $user_id["id"];
							return $this->projects->self_update_project($this->payload->name,
								$this->payload->description,$this->payload->company_id);
						}
					}else{
						if (!$this->contains(array('name','description','company_id'))) {
							//return resposne constructed by contains()
							return $this->response;
						}else{
							return $this->projects->update_project($this->args[0],$this->payload->name,
								$this->payload->description,$this->payload->company_id);
						}					
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
					//get all projects
					return array('error' => 'please choose a project to delete');
				}else{
						return $this->projects->delete_project($this->args[0]);
					}					
				}
			}
	}

?>