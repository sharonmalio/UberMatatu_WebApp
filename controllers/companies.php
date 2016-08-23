<?php 
	/**
	* 
	*/
	class CompaniesController extends Controller
	{
		
		private $companies;

		function __construct($method, $verb, $args, $file)
		{
			$this->companies = new Companies();

			parent::__construct($method, $verb, $args, $file);
		}
		function CompaniesController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all companies
					return $this->companies->all();
				}else{
					//get a specific company by id
					return $this->companies->get_company($this->args[0]);
				}
			}
		}

		function POST(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				//add company
				//return print_r($this->payload->description);
				if (!$this->contains(array('name','description'))) {
						//return resposne constructed by contains()
						return $this->response;
				}else{
					return $this->companies->add_company($this->payload->name,$this->payload->description);
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
					//get all companies
					return array('error' => 'please choose a company to update');
				}else{
					if (!$this->contains(array('name','description'))) {
						//return resposne constructed by contains()
						return $this->response;
					}else{
						return $this->companies->update_company($this->args[0],$this->payload->name,
							$this->payload->description);
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
					//get all companies
					return array('error' => 'please choose a company to delete');
				}else{
						return $this->companies->delete_company($this->args[0]);
					}					
				}
			}
	}

?>