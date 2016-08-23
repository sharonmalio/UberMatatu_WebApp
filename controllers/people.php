<?php 
	/**
	* 
	*/
	class PeopleController extends Controller
	{
		
		private $people;

		function __construct($method, $verb, $args, $file)
		{
			$this->people = new People();

			parent::__construct($method, $verb, $args, $file);
		}
		function PeopleController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all people
					return $this->people->all();
				}else{
					//get a specific person by user_id
					return $this->people->get_person($this->args[0]);
				}
			}
		}

		function POST(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				//add person
				//return print_r($this->payload->model_id);
				if (!$this->contains(array('fName','lName','phone_no','type','user_id'))) {
						//return resposne constructed by contains()
						return $this->response;
				}else{
					return $this->people->add_person($this->payload->fName,$this->payload->lName,
					$this->payload->phone_no,$this->payload->type,$this->payload->user_id);
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
					//get all people
					return array('error' => 'please choose a person to update');
				}else{
					if (!$this->contains(array('fName', 'lName','phone_no','type'))) {
						//return resposne constructed by contains()
						return $this->response;
					}else{
						return $this->people->update_person($this->args[0],$this->payload->fName,$this->payload->lName,$this->payload->phone_no,$this->payload->type);
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
					//get all people
					return array('error' => 'please choose a person to delete');
				}else{
						return $this->people->delete_person($this->args[0]);
					}					
				}
			}
	}

?>