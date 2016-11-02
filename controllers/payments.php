<?php 
	/**
	* 
	*/
	class PaymentsController extends Controller
	{
		
		private $payments;

		function __construct($method, $verb, $args, $file, $headers)
		{
			$this->payments = new Payments();

			parent::__construct($method, $verb, $args, $file, $headers);
		}
		function PaymentsController(){
		}

		function GET(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
				if (!$this->args) {
					//get all payments
					return $this->payments->all();
				}
			}
		}

		

		function PUT(){
			if (!$this->headerContains(array('authorisation') )) {
				//return response constructed by contains()
				return $this->response;
			}
			else{
					if (!$this->contains(array('trip_id','payment_method','transaction_id'))) {
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
										$res[]=$this->payments->make_payment($array_value->trip_id,$array_value->payment_method,$array_value->transaction_id);
									}

									return $res;
						}
				
			}
		}

	
	}

?>