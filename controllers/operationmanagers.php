<?php 
	/**
	* 
	*/
	class OperationmanagersController extends Controller
	{
		
		private $operationmanagers;

		function __construct($method, $verb, $args, $file)
		{
			$this->operationmanagers = new Operationmanagers();

			parent::__construct($method, $verb, $args, $file);
		}
		function OperationmanagersController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all operationmanagers
					return $this->operationmanagers->all();
				}else{
					//get a specific operationmanager by operationmanager_id
					return $this->operationmanagers->get_operationmanager($this->args[0]);
				}
			}
		}


	}

?>