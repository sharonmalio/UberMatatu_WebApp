<?php 
	/**
	* 
	*/
	class StaffController extends Controller
	{
		
		private $staff;

		function __construct($method, $verb, $args, $file)
		{
			$this->staff = new Staff();

			parent::__construct($method, $verb, $args, $file);
		}
		function StaffController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all staffs
					return $this->staff->all();
				}else{
					//get a specific staff by staff_id
					return $this->staff->get_staff($this->args[0]);
				}
			}
		}


	}

?>