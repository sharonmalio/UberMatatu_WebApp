<?php 
	
	/**
	* 
	*/
	class ActivitiesController extends Controller
	{
		
		function __construct($method, $verb, $args, $file)
		{
			if (!$this->headerContains(array('authorisation','accept') )) {
				//return response constructed by contains()
				return $this->response;
			}

			parent::__construct($method, $verb, $args, $file);
		}

		function GET(){
			switch ($this->verb) {
				case 'me':
					//get me
					$uid = $this->token->uid;
					$acts = new Activities($uid);
					$acts->getUserActivities();
					return array('data' => 'me');
					break;
				case 0:
					//get all
					$uid = $this->token->uid;
					$acts = new Activities($uid);
					$acts->getAllActivities();
					return array('data' => 'me');
					break;
				default:
					return $this->error('invalid query');
					break;
			}
		}
		function PUT(){

		}
	}

?>