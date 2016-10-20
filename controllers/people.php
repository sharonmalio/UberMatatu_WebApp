<?php 
	/**
	* 
	*/
	class PeopleController extends Controller
	{
		
		private $people;

		function __construct($method, $verb, $args, $file, $headers)
		{
			$this->people = new People();

			parent::__construct($method, $verb, $args, $file, $headers);
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

		

		function PUT(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if ($this->verb=="many") {
					return 0;
				}else{
					if (!$this->args) {
						//get all people
						//return array('error' => 'please choose a person to update');
						//return $this->payload;
						return ($this->contains(array('fName','lName','phone_no','email')));
						/*foreach ($this->payload as $key => $value) {
							if (!$this->contains(array('fName','lName','phone_no','email'))) {
								//return response constructed by contains()
								return $this->response;
							}
						}*/
						if (!$this->contains(array('fName','lName','phone_no','email'))) {
							//return response constructed by contains()
							return $this->response;
						}else{
							$user_id=$this->token->getUser();
							//return $user_id["id"];
							return $this->people->self_update_person($user_id["id"],$this->payload->fName,
								$this->payload->lName,$this->payload->phone_no,$this->payload->email);
						}
					}else{
						if (!$this->contains(array('fName','lName','phone_no','type','email'))) {
							//return resposne constructed by contains()
							return $this->response;
						}else{
							return $this->people->update_person($this->args[0],$this->payload->fName,
								$this->payload->lName,$this->payload->phone_no,$this->payload->type);
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
					//get all people
					return array('error' => 'please choose a person to delete');
				}else{
						return $this->people->delete_person($this->args[0]);
					}					
				}
			}
	}

?>