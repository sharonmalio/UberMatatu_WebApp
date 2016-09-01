<?php 
	/**
	* 
	*/
	class MakesController extends Controller
	{
		
		private $makes;

		function __construct($method, $verb, $args, $file)
		{
			$this->makes = new Makes();

			parent::__construct($method, $verb, $args, $file);
		}
		function MakesController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all makes
					return $this->makes->all();
				}else{
					//get a specific make by make_id
					return $this->makes->get_make($this->args[0]);
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
					if (!$this->contains(array('make'))) {
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
									if (isset($array_value->make_id)) {
										$make_id=$array_value->make_id;
									}*/
									$res[]=$this->makes->add_make($array_value->make);
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
					if (!$this->contains(array('make','id'))) {
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
										$res[]=$this->makes->update_make($array_value->id,$array_value->make);
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
				if (!$this->contains(array('id'))) {
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
										$res[]=$this->makes->delete_make($array_value->id);
									}

									return $res;
						}					
					}
		}
	}

?>