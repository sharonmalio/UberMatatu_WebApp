<?php
	include 'api.class.php';
	include 'models.php';
	include 'controllers.php';

	class caAPI extends API
	{
	    protected $User;



	    public function __construct($request, $origin) {
	        parent::__construct($request);

	        if($this->verb != 'signin'){    	
		        // Abstracted out for example
		        //$APIKey = new Models\APIKey();
		        $User = new User();

		        /*if (!array_key_exists('apiKey', $this->request)) {
		            throw new Exception('No API Key provided');
		        } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
		            throw new Exception('Invalid API Key');
		        } else if (array_key_exists('token', $this->request) &&
		             !$User->get('token', $this->request['token'])) {

		            throw new Exception('Invalid User Token');
		        }
				*/
		        $this->User = $User;
	        }else{
	        	//$Access = new APIAccess();
	        }
	    }

	 }
		

	// Requests from the same server don't have a HTTP_ORIGIN header
	if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
	    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
	}

	try {
	    $API = new caAPI($_REQUEST['q'], $_SERVER['HTTP_ORIGIN']);
	    echo $API->processAPI();
	} catch (Exception $e) {
	    echo json_encode(Array('error' => $e->getMessage()));
	}

	
	
?>