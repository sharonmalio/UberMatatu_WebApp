<?php 
	require_once 'constants.php';

	function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
                try
                {
                        // connect to database
                        $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

                        // ensure that PDO::prepare returns false when passed invalid SQL
                        $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                }
                catch (Exception $e)
                {
                        // trigger (big, orange) error
                        trigger_error($e->getMessage(), E_USER_ERROR);
                        exit;
                }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            $error_x = $handle->errorInfo();
            // trigger (big, orange) error
            trigger_error($error_x[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false)
        {
            //  pre($sql);
            $length = strlen("INSERT");
            if((substr($sql, 0, $length) === "INSERT")){
                //if it is insert statement
                //echo "INSERT";
                //echo($handle->lastInsertId());
                return $handle->lastInsertId();
            }
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
                return $results;
        }
    }

    function pre($data){
		//echo "<pre>";
		print_r($data);
		//echo "</pre>";
	}
    function getDistance( $lat1, $long1, $lat2, $long2 ) {  
        $earth_radius = 6371;

        $dLat = deg2rad( $lat2 - $lat1 );  
        $dLon = deg2rad( $long2 - $long1 );  

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);  
        $c = 2 * asin(sqrt($a));  
        $d = $earth_radius * $c;  

        return $d;
    }

     

    function array_change_key_case_unicode($arr, $c = CASE_LOWER) {
        $c = ($c == CASE_LOWER) ? MB_CASE_LOWER : MB_CASE_UPPER;
        foreach ($arr as $k => $v) {
            $ret[mb_convert_case($k, $c, "UTF-8")] = $v;
        }
        return $ret;
    }


    function includeController($name){
        if (file_exists(CONTROLS_PATH.$name.".php")) {
            require_once (CONTROLS_PATH.$name.".php");
            return true;
        }else{
            return false;   
        }
    }
    function includeModel($name){
        $name = ucwords($name);
        if (file_exists(MODELS_PATH.$name.".php")) {
            require_once (MODELS_PATH.$name.".php");
            return true;
        }else{
            return false;   
        }
    }

    function getLocDistance( $lat1, $long1, $lat2, $long2 ) {  
        $api_key = "AIzaSyBt4k4MexJSiLU_yFCeeH1tr7H0IjZLql8";
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json";
        $params = array('units' => 'metric',
                        'origins' => $lat1.",".$long1,
                        'destinations' => $lat2.",".$long2,
                        'transit_mode' => 'bus',
                        'departure_time' => 'now',
                        'key' => $api_key,
         );
        $res = sendRequest($url, 'GET', $params); 
        //var_dump($res);
        $res_obj = json_decode($res);
        $elements = $res_obj->rows[0]->elements[0];
        //var_dump($elements);
        //die();
        return array('start_name' => $res_obj->destination_addresses[0],
                'stop_name' => $res_obj->origin_addresses[0],
                'distance' => $elements->distance->value,
                'duration' => $elements->duration->value,
                'duration_traffic' => $elements->duration_in_traffic->value,
                 );
    }

    function sendRequest($url, $method, $parameters){
        $query_params = http_build_query($parameters,'', '&');
        $url = $url ."?". $query_params;

        $ch = curl_init(); 

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=AIzaSyCbidL9CDA4wO_Fmq0WMNt7p0pl2rG8Yzg'
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        $output = curl_exec($ch); 

        $http_status = curl_getinfo($ch , CURLINFO_HTTP_CODE);

        curl_close($ch); 

        return $output;
    }
?>