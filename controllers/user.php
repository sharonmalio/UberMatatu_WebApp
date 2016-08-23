<?php 
	/**
	* 
	*/
	class UserController extends Controller
	{
		
		private $user;

		function __construct($method, $verb, $args, $file)
		{
			$this->user = new User();

			parent::__construct($method, $verb, $args, $file);
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
					return 0;
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
					return $this->user->signin($this->payload->email,
						$this->payload->password,$this->api_access);
					break;
				case 'signup':
					if (!$this->contains(array('email','password'))) {
						//return resposne constructed by contains()
						return $this->response;
					}
					return $this->user->signup($this->payload->email,$this->payload->password);
					
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