<?php
/*Sandbox*/ 
/*define("ENDPOINT_ONLINE_PAYMENT", "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest");
define("ENDPOINT_ONLINE_PAYMENT_STATUS", "https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query");
define("ENDPOINT_TRANSACTION_STATUS", "https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query");
define("ENDPOINT_GENERATE_TOKEN", "https://sandbox.safaricom.co.ke/oauth/v1/generate");
define("ENDPOINT_PAYMENT_REQUEST", "https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest");
define("ENDPOINT_MPESA", "https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate");
*/
define("ENDPOINT_ONLINE_PAYMENT", "https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest");
define("ENDPOINT_ONLINE_PAYMENT_STATUS", "https://api.safaricom.co.ke/mpesa/stkpushquery/v1/query");
define("ENDPOINT_TRANSACTION_STATUS", "https://api.safaricom.co.ke/mpesa/transactionstatus/v1/query");
define("ENDPOINT_GENERATE_TOKEN", "https://api.safaricom.co.ke/oauth/v1/generate");
define("ENDPOINT_PAYMENT_REQUEST", "https://api.safaricom.co.ke/mpesa/b2b/v1/paymentrequest");
define("ENDPOINT_MPESA", "https://api.safaricom.co.ke/mpesa/c2b/v1/simulate");

define("CALL_BACK_URL", "https://dutycalc.co.ke/paybill.php");

//define('CONSUMER_KEY', 'gazTvEuO8Pagfjp1HZIuwc1a1os0PzMk'); /*Test*/
define('CONSUMER_KEY', 'lBQ112RlkrRxhOhgQF4p8kwsjG4iT15g'); /*Techmata*/
//define('CONSUMER_SECRET', 'UEClkfS9iVdGXiQ8'); /*Test*/
define('CONSUMER_SECRET', 'zRAsURFooz6R0QlA'); /*Techmata*/

//define('PAYBILL_NO', '174379'); /*Test*/
define('PAYBILL_NO', '963775'); /*Techmata*/
//define('PASSKEY', 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919'); /*Test*/
define('PASSKEY', '283ba320ca9b3ada6f36c51173a806369ba17b8a0538059ce65809e848d0b906'); /*Techmata*/
//define('PASSKEY', '94b220ea797891ff7213b44ca4cce9699b8b48963b16f3c1a4d133342cbeba3e'); /*Dutycalc*/

function main(){
	$AMOUNT = "1";
	$NUMBER = "254721630033";
	//$NUMBER = "254729444987";
	$MERCHANT_TRANSACTION_ID = generateRandomString();
	
	$mpesa = new Mpesa();
	
	/*
	die();
	*/
	var_dump($mpesa->statusOnlinePayment('ws_CO_03112017184043800'));
	die();

	$res = $mpesa->actionOnlinePayment($AMOUNT,$NUMBER,$MERCHANT_TRANSACTION_ID," MY-TKT ");
	var_dump($res);
	var_dump($mpesa->statusOnlinePayment($res->CheckoutRequestID));
	die();
	//$res = $mpesa->actionCheckIdentity($AMOUNT,$NUMBER,$MERCHANT_TRANSACTION_ID,"Techmata");
}

class Mpesa
{
	private $PAYBILL_NO = PAYBILL_NO;
    private $ACCESS_TOKEN;
    private $TIMESTAMP;
    private $PASSWORD;
    
    public function __construct(){
    	$this->ACCESS_TOKEN = $this->actionGenerateToken();
        $this->TIMESTAMP = date("YmdHis",time());
        $this->PASSWORD = base64_encode(PAYBILL_NO.PASSKEY.$this->TIMESTAMP);
    }

    public function actionOnlinePayment($amount,$phone_no,$merchant_transaction_id,$description = "Payment"){
		/*
		{
	      "BusinessShortCode": "909170",
	      "Password": "94b220ea797891ff7213b44ca4cce9699b8b48963b16f3c1a4d133342cbeba3e",
	      "Timestamp": "1507708116 ",
	      "TransactionType": "CustomerPayBillOnline",
	      "Amount": "500",
	      "PartyA": "254721630033",
	      "PartyB": "909170",
	      "PhoneNumber": "254721630033",
	      "CallBackURL": "",
	      "AccountReference": "abcd123",
	      "TransactionDesc": ""
	    }
		*/

        $payload = array(
        	'BusinessShortCode' => PAYBILL_NO,
            'Password' => $this->PASSWORD,
            'Timestamp' => $this->TIMESTAMP,
            'TransactionType' => "CustomerPayBillOnline",
            'Amount' => $amount,
            'PartyA' => $phone_no,
            'PartyB' => PAYBILL_NO,
            'PhoneNumber' => $phone_no,
            'CallBackURL' => CALL_BACK_URL,
            'AccountReference' => $merchant_transaction_id,
            'TransactionDesc' => $description
        ) ;

        return $this->processRequest(ENDPOINT_ONLINE_PAYMENT,$payload);
    }

    public function statusOnlinePayment($CheckoutRequestID){
		/*{
		        "BusinessShortCode": " " ,
		        "Password": " ",
		        "Timestamp": " ",
		        "CheckoutRequestID": " "
		}*/
        
        $payload = array(
        	'BusinessShortCode' => PAYBILL_NO,
            'Password' => $this->PASSWORD,
            'Timestamp' => $this->TIMESTAMP,
            'CheckoutRequestID' => $CheckoutRequestID
        );
        
        return $this->processRequest(ENDPOINT_ONLINE_PAYMENT_STATUS,$payload);
    }
   
    public function actionGenerateToken(){
		/*{
		        "BusinessShortCode": " " ,
		        "Password": " ",
		        "Timestamp": " ",
		        "CheckoutRequestID": " "
		}*/

		$headers = array(
			"Content-type: application/json",
            "cache-control: no-cache",
            "Accept: application/json"
        );

        $payload = array(
        	'grant_type' => 'client_credentials'
        );

        $curl = curl_init();

        $query = http_build_query($payload);

		curl_setopt_array($curl, array(
		  CURLOPT_URL => ENDPOINT_GENERATE_TOKEN."?".$query,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_USERPWD => CONSUMER_KEY . ":" . CONSUMER_SECRET,
		  CURLOPT_HTTPHEADER => $headers,
		));
        
        $response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  	$resObject = json_decode($response);
			print_r($resObject);
			$this->ACCESS_TOKEN = $resObject->access_token;
			return $resObject->access_token;
		}
    }

    public function actionCheckIdentity($amount,$phone_no,$merchant_transaction_id,$description = "Payment"){
        $payload = array(
        	'BusinessShortCode' => PAYBILL_NO,
            'Password' => $this->PASSWORD,
            'Timestamp' => $this->TIMESTAMP,
            'TransactionType' => "CustomerPayBillOnline",
            'CommandID' => "CustomerPayBillOnline",
            'Amount' => $amount,
            'PartyA' => $phone_no,
            'PartyB' => PAYBILL_NO,
            'PhoneNumber' => $phone_no,
            'CallBackURL' => CALL_BACK_URL,
            'AccountReference' => $merchant_transaction_id,
            'TransactionDesc' => $description
        ) ;

        return $this->processRequest(ENDPOINT_ONLINE_PAYMENT,$payload);
    }
  
    private function processRequest($url,$payload){
 		$headers = array("Content-type: application/json",
                         "Authorization: Bearer ".$this->ACCESS_TOKEN,
                         "cache-control: no-cache",
                         "Accept: application/json");

        $curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($payload),
		  CURLOPT_HTTPHEADER => $headers,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  return json_decode($response);
		}
    }            
}

function generateRandomString($length=10) {
    $characters = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//main();

?>