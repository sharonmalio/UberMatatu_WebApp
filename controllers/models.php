<?php 
	/**
	* 
	*/
	class ModelsController extends Controller
	{
		
		private $models;

		function __construct($method, $verb, $args, $file)
		{
			$this->models = new Models();

			parent::__construct($method, $verb, $args, $file);
		}
		function ModelsController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all models
					return $this->models->all();
				}else{
					//get a specific model by model_id
					return $this->models->get_model($this->args[0]);
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
					if (!$this->contains(array('model','make_id'))) {
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
									if (isset($array_value->model_id)) {
										$model_id=$array_value->model_id;
									}*/
									$res[]=$this->models->add_model($array_value->model,$array_value->make_id);
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
				if ($this->verb=="many") {
					$payload_array=array();
						$res=array();
						if (!is_array($this->payload)) {
							$payload_array[]=$this->payload;	
						}else{
							$payload_array=$this->payload;
						}
					foreach ($payload_array as $array_key => $array_value) {
							$id=NULL;
							
							if (isset($array_value->company_id)) {
								$company_id=$array_value->company_id;
							}
							if (isset($array_value->model_id)) {
								$model_id=$array_value->model_id;
							}
							$res[]=$this->models->update_model($array_value->id,$array_value->model,$array_value->make_id);
						}

						return $res;	
					
				}else{
					if (!$this->args) {
						//get all models
						//return array('error' => 'please choose a model to update');
						//return $this->payload;
						return ($this->contains(array('model','make_id')));
						/*foreach ($this->payload as $key => $value) {
							if (!$this->contains(array('model','make_id'))) {
								//return response constructed by contains()
								return $this->response;
							}
						}*/
						if (!$this->contains(array('model','make_id'))) {
							//return response constructed by contains()
							return $this->response;
						}else{
							// $model_id=$this->token->getUser();
							//return $model_id["id"];
							return $this->models->self_update_model($this->payload->model,$this->payload->make_id);
						}
					}else{
						if (!$this->contains(array('model','make_id'))) {
							//return resposne constructed by contains()
							return $this->response;
						}else{
							return $this->models->update_model($this->args[0],$this->payload->model,$this->payload->make_id);
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
					//get all models
					return array('error' => 'please choose a model to delete');
				}else{
						return $this->models->delete_model($this->args[0]);
					}					
				}
			}
	}

?>