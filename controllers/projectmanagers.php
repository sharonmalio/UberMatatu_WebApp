<?php 
	/**
	* 
	*/
	class ProjectmanagersController extends Controller
	{
		
		private $projectmanagers;

		function __construct($method, $verb, $args, $file, $headers)
		{
			$this->projectmanagers = new Projectmanagers();

			parent::__construct($method, $verb, $args, $file, $headers);
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


	}

?>