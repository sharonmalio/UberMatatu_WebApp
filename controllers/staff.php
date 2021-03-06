<?php 
	/**
	* 
	*/
	class StaffController extends Controller
	{
		
		private $staff;

		function __construct($method, $verb, $args, $file, $headers)
		{
			$this->staff = new Staff();

			parent::__construct($method, $verb, $args, $file, $headers);
		}
		function StaffController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if($this->verb == "fellow"){
					$staff=$this->token->getUser();

					return $this->staff->get_fellow_staff($staff['id']);
				}
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