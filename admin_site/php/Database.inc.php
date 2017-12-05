<?php

class Database{

    private $connection = null;
    protected $USERNAME = 'root';
    protected $PASSWORD = '';
    protected $DATABASE = 'transcomfy';

    function __construct(){
        $this->connection = new mysqli('localhost',$this->USERNAME,$this->PASSWORD,$this->DATABASE);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function insert($sql,$get_pk_id=false){
        if ($this->connection->query($sql) === TRUE) {
            if($get_pk_id){
                return $this->connection->insert_id;
            }
            return true;
        } else {
            die("Error: " . $sql . "<br>" . $this->connection->error);
        }
    }

    public function update($sql){
        if ($this->connection->query($sql) === TRUE) {
            return true;
        } else {
            die("Error: " . $sql . "<br>" . $this->connection->error);
        }
    }

    public function delete($sql){
        if ($this->connection->query($sql) === TRUE) {
            return true;
        } else {
            die("Error: " . $sql . "<br>" . $this->connection->error);
        }
    }

    public function select($sql){
        $result = $this->connection->query($sql);
        $resut_array = [];
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resut_array[] = $row;
            }
            $result->free();
            $json = json_encode($resut_array);
            return json_decode($json);
        } else {
            return null;
        }
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->connection->close();
    }

}

?>