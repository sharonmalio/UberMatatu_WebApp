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
					if($this->verb == "trips"){
						$company_head=$this->token->getUser();

						return $this->companies->company_trips($company_head['id']);

					}
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
									$res[]=$this->companies->add_company($array_value->name,$array_value->description);
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