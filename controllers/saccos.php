<?php 
	/**
	* 
	*/
	class SACCOSController extends Controller
	{
		
		private $companies;

		function __construct($method, $verb, $args, $file, $headers)
		{
			$this->companies = new Companies();

			parent::__construct($method, $verb, $args, $file, $headers);
		}
		function CompaniesController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				
					if($this->verb == "trips"){
						$company_head=$this->token->getUser();

						return $this->companies->company_trips($company_head['id']);
					}
					if($this->verb == "projects"){
						$company_head=$this->token->getUser();

						return $this->companies->company_project($company_head['id']);

					}
				
				
					if($this->verb == "projectmanagers"){
						$company_head=$this->token->getUser();

						return $this->companies->projectmanagers($company_head['id']);

					}

					if($this->verb == "staff"){
						$company_head=$this->token->getUser();

						return $this->companies->company_staff($company_head['id']);

					}


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
				
					if (!$this->contains(array('id','name','description'))) {
						//return resposne constructed by contains()
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
									
									$res[]=$this->companies->update_company($array_value->id,$array_value->name,$array_value->description);
								}

								return $res;
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