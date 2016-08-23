<?php 
	
	/**
	* 
	*/
	class ActivityController extends Controller
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
			//TODO ensure verb is int
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
		function POST(){
			//Add new activity
			//no verb
			if($this->verb != null)
				return $this->error('invalid query');

			//set group_id / user_id to 0 when not in use
			if (!$this->contains(array('title','enabled','description','type','user_id','group_id','times'))) {
						//return response constructed by contains()
						return $this->response;
			}
		}
		function PUT(){
			//Update existing activity
			$act_id = $this->verb;
			//set group_id / user_id to 0 when not in use
			if (!$this->contains(array('title','enabled','description','type','user_id','group_id'))) {
						//return response constructed by contains()
						return $this->response;
			}

		}
		function DELETE(){
			$act_id = $this->verb;
		}
	}

?>