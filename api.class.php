<?php 
abstract class API
	{
	    /**
	     * Property: method
	     * The HTTP method this request was made in, either GET, POST, PUT or DELETE
	     */
	    protected $method = '';

	    protected $headers = array();
	    /**
	     * Property: endpoint
	     * The Model requested in the URI. eg: /files
	     */
	    protected $endpoint = '';
	    /**
	     * Property: verb
	     * An optional additional descriptor about the endpoint, used for things that can
	     * not be handled by the basic methods. eg: /files/process
	     */
	    protected $verb = '';
	    /**
	     * Property: args
	     * Any additional URI components after the endpoint and verb have been removed, in our
	     * case, an integer ID for the resource. eg: /<endpoint>/<verb>/<arg0>/<arg1>
	     * or /<endpoint>/<arg0>
	     */
	    protected $args = Array();
	    /**
	     * Property: file
	     * Stores the input of the PUT request
	     */
	     protected $file = Null;

	     private static $controllers = array();

	    /**
	     * Constructor: __construct
	     * Allow for CORS, assemble and pre-process the data
	     */
	    public function __construct($request) {
	        header("Access-Control-Allow-Orgin: *");
	        header("Access-Control-Allow-Methods: *");
	        header("Content-Type: application/json");

	        $this->headers = getallheaders();
	        //convert all to lowercase
			array_change_key_case($this->headers,CASE_LOWER);

	        $this->args = explode('/', rtrim($request, '/'));
	        $this->endpoint = array_shift($this->args);
	        if (array_key_exists(0, $this->args) && !is_numeric($this->args[0])) {
	            $this->verb = array_shift($this->args);
	        }

	        $this->method = $_SERVER['REQUEST_METHOD'];
	        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
	            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
	                $this->method = 'DELETE';
	            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
	                $this->method = 'PUT';
	            } else {
	                throw new Exception("Unexpected Header");
	            }
	        }

	        switch($this->method) {
	        case 'DELETE':
	        	$this->file = json_decode(file_get_contents("php://input"));
	        	break;
	        case 'POST':
	            $this->request = $this->_cleanInputs($_POST);
	            $this->file = json_decode(file_get_contents("php://input"));
	            break;
	        case 'GET':
	            $this->request = $this->_cleanInputs($_GET);
	            break;
	        case 'PUT':
	            $this->request = $this->_cleanInputs($_GET);
	            $this->file = json_decode(file_get_contents("php://input"));
	            break;
	        default:
	            $this->_response('Invalid Method', 405);
	            break;
	        }
	    }

	    public function processAPI() {
        	if (file_exists(__DIR__."/controllers/".$this->endpoint.".php")) {
        		require_once (__DIR__."/controllers/".$this->endpoint.".php");
        		/*
        		* Call corresponding class
        		*/
        		$cont = ucfirst($this->endpoint)."Controller";
        		$class = new $cont($this->method,$this->verb,
        							$this->args,$this->file,$this->headers);
        		return  $this->_response($class->response(),$class->rescode());
        	}
        	return $this->_response(array('response' => 'not found' ), 404);
	    }

	    private function _response($data, $status = 200) {
	        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
	        return json_encode($data);
	    }

	    private function _cleanInputs($data) {
	        $clean_input = Array();
	        if (is_array($data)) {
	            foreach ($data as $k => $v) {
	                $clean_input[$k] = $this->_cleanInputs($v);
	            }
	        } else {
	            $clean_input = trim(strip_tags($data));
	        }
	        return $clean_input;
	    }

	    private function _requestStatus($code) {
	        $status = array(  
	            200 => 'OK',
	            400 => 'Bad Request',   
	            404 => 'Not Found',   
	            405 => 'Method Not Allowed',
	            500 => 'Internal Server Error',
	        ); 
	        return ($status[$code])?$status[$code]:$status[500]; 
	    }
}
?>