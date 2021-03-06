<?php 
	/**
	* 
	*/
	class UserController extends Controller
	{
		
		private $user;

		function __construct($method, $verb, $args, $file, $headers)
		{
			$this->user = new User();

			parent::__construct($method, $verb, $args, $file, $headers);
		}
		function UserController(){
		}

		function GET(){
			switch ($this->verb) {
				case 'me':
					if (!$this->headerContains(array('authorisation') )) {
						//return response constructed by contains()
						return $this->response;
					}
					//get me
					return $this->token->getUser();
					break;
				default:
					return $this->error('invalid query');
					break;
			}
		}

		function POST(){
			switch ($this->verb) {
				case 'signin':
					if (!$this->contains(array('email','password','api_key'))) {
						//return response constructed by contains()
						return $this->response;
					}
					else{
								$payload_array=array();
								$array_value = $this->payload;
								/*$res=array();
								if (!is_array($this->payload)) {
									$payload_array[]=$this->payload;	
								}else{
									$payload_array=$this->payload;
								}*/
								//foreach ($payload_array as $array_key => $array_value) {
									/*if (isset($array_value->company_id)) {
										$company_id=$array_value->company_id;
									}
									if (isset($array_value->model_id)) {
										$model_id=$array_value->model_id;
									}*/
									$res=$this->user->signin($array_value->email,$array_value->password,$this->api_access);
								//}

								return $res;
						}
					
					break;
				case 'signup':
						if (!$this->contains(array('fname','lname','phone_no','email','password','api_key'))) {
							//return resposne constructed by contains()
							return $this->response;
						}
						$payload_array=array();
						//$res=array();
						if (!is_array($this->payload)) {
							$payload_array[]=$this->payload;	
						}else{
							$payload_array=$this->payload;
						}
						foreach ($payload_array as $array_key => $array_value) {
							$company_id=1;
							$project_id=1;
							if (isset($array_value->company_id)) {
								$company_id=$array_value->company_id;
							}
							if (isset($array_value->project_id)) {
								$project_id=$array_value->project_id;
							}
							$res = $this->user->signup($array_value->fname,$array_value->lname,$array_value->phone_no,$array_value->email,$array_value->password,
								1,$company_id,$project_id);
						}

						return $res;					
					break;
				
				default:
					return $this->error('invalid query');
					break;
			}
		}

		function signup($email, $pass){
			return $this->user->register($email,$pass);
		}

	}

?>