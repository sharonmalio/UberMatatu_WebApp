	<?php 
		abstract class Controller
		{
			protected $method;
			protected $headers = null;
			protected $verb;
			protected $args  = array();
			protected $payload  = array(); //data from payload
			protected $response = array('response' => 'null');
			protected $rescode = 200;
			protected $api_access = null;
			protected $token = null;

			function __construct($m, $v, $a, $file)
			{
				$this->method = $m;
				$this->verb = $v;
				$this->args = $a;
				$this->payload = ($file == null) ? array() : $file; //When the payload is not JSON

				switch($this->method) {
			        case 'DELETE':
			        	if (method_exists($this, "DELETE")) {
				            $this->response = $this->DELETE();
				            break;
				        }
				        $this->response = $this->error("No Endpoint DELETE",405);
			        	break;
			        case 'POST':
			            if (method_exists($this, "POST")) {
				            $this->response = $this->POST();
				            break;
				        }
				        $this->response = $this->error("No Endpoint for POST",405);
			        	break;
			        case 'GET':
						$this->headers = getallheaders();
			           if (method_exists($this, "GET")) {
				            $this->response = $this->GET();
				            break;
				        }
				        $this->response = $this->error("No Endpoint for GET",405);
			        	break;
			        case 'PUT':
			            if (method_exists($this, "PUT")) {
				            $this->response = $this->PUT();
				            break;
				        }
				        $this->response = $this->error("No Endpoint for PUT",405);
			        	break;
			        default:
			            $this->error('Invalid Method', 405);
			            break;
		        }
				
			}
			
			public function error($err, $errcode = 400){
				$this->response = array('error' => "$err");
				$this->rescode = $errcode;
				return $this->response;
			}
			public function contains($c,$dealbreaker = true){
				//return $c;
				//return is_array($this->payload);
				$payload_array=array();
				if (!is_array($this->payload)) {
					$payload_array[]=$this->payload;	
				}else{
					$payload_array=$this->payload;
				}
				foreach ($payload_array as $array_key => $array_value) {
					//return $array_value;
					//return print_r($array_value->email);
					foreach ($c as $key => $value) {
						//return $value;
						if (!array_key_exists($value, $array_value) && $dealbreaker) {
							$this->error("$value required");
							return false;
						}
						//validation
						if(isset($array_value->email)&& !filter_var($array_value->email, FILTER_VALIDATE_EMAIL)){
							$this->error('invalid email');
							return false;
						}
						//Validate APIkey
						if(isset($array_value->api_key)){
							$this->api_access = new APIAccess($array_value->api_key);
							if(!$this->api_access->verifyKey()){
								$this->error('invalid API key');
								return false;
							}
						}
					}
				}

				/*foreach ($c as $key => $value) {
						if (!array_key_exists($value, $this->payload) && $dealbreaker) {
							$this->error("$value required");
							return false;
						}
						//validation
						if($value == 'email' && !filter_var($this->payload->email, FILTER_VALIDATE_EMAIL)){
							$this->error('invalid email');
							return false;
						}
						//Validate APIkey
						if($value == 'api_key'){
							$this->api_access = new APIAccess($this->payload->api_key);
							if(!$this->api_access->verifyKey()){
								$this->error('invalid API key');
								return false;
							}
						}
					}*/	
				return true;
			}

			public function headerContains($c,$dealbreaker = true){
				$this->headers = ($this->headers == null)? getallheaders(): $this->headers;
				//pre($this->headers);
				foreach ($c as $key => $value) {
						if (!array_key_exists($value, $this->headers) && $dealbreaker) {
							$this->error("$value required");
							//TODO: implement dealbreaker
							return false;
						}
						//TODO: validation
						if($value == 'authorisation'){
							$query = 'Bearer ';
							if(substr($this->headers['authorisation'],0, strlen($query)) !== $query){
								$this->error('invalid Authorisation');
								return false;
							}
							//Validate Token
							/*$mytoken = str_replace($query,'', $this->headers['authorisation']);
							echo $mytoken;*/
							$t = new Token(str_replace($query,'', $this->headers['authorisation']));
							if(!$t->verifyToken()){
								$this->error('invalid token');
							}
							$this->token = $t;
							return true;
						}
					}	
				return true;
			}
			
			public function response(){
				return $this->response;
			}
			public function rescode(){
				return $this->rescode;
			}
		}

	?>