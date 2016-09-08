<?php 
	/**
	* 
	*/
	class StaffsController extends Controller
	{
		
		private $staffs;

		function __construct($method, $verb, $args, $file)
		{
			$this->staffs = new Staffs();

			parent::__construct($method, $verb, $args, $file);
		}
		function StaffsController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all staffs
					return $this->staffs->all();
				}else{
					//get a specific staff by staff_id
					return $this->staffs->get_staff($this->args[0]);
				}
			}
		}


	}

?>