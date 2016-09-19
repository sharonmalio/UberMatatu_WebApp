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

    function array_change_key_case_unicode($arr, $c = CASE_LOWER) {
        $c = ($c == CASE_LOWER) ? MB_CASE_LOWER : MB_CASE_UPPER;
        foreach ($arr as $k => $v) {
            $ret[mb_convert_case($k, $c, "UTF-8")] = $v;
        }
        return $ret;
    }
?>