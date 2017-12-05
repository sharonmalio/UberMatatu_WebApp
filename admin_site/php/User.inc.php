<?php

include('Database.inc.php');

class User{

    protected $is_logged_in;
    protected $failed_login_message = "";

    function __construct(){
        session_start();
        if(isset($_SESSION['active_user'])){
            $this->is_logged_in=true;
        }
    }

    public function login($post_data){
        $email_address=$post_data['admin_email_address'];

        $sql="SELECT * FROM `tbl_saccos_admins` 
WHERE `email_address`='$email_address'";

        $db=new Database();
        $user = $db->select($sql)[0];

        if($user==null){
            $this->is_logged_in=false;
            $this->failed_login_message = "The user does not exist.";
            return;
        }

        if(password_verify($post_data['admin_password'],$user->password)){
            $_SESSION['user_name'] = $user->first_name." ".$user->last_name;
            $_SESSION['sacco_id'] = $user->sacco_id;
            $_SESSION['active_user'] = true;
            $this->is_logged_in=true;
            return;
        }else{
            $this->is_logged_in=false;
            $this->failed_login_message = "Invalid password.";
            return;
        }

    }

    public function register($post_data){
        $db = new Database();
        $sql="INSERT INTO `tbl_saccos`(`name`, `description`)
VALUES ('".$post_data['sacco_name']."','".$post_data['sacco_description']."')";

        $SACCO_ID=$db->insert($sql,true);

        $sql="INSERT INTO `tbl_saccos_admins`(`sacco_id`, `first_name`, `last_name`, `phone_number`, `email_address`, `password`)
VALUES ('".$SACCO_ID."','".$post_data['admin_first_name']."','".$post_data['admin_last_name']."','+254".$post_data['admin_phone_number'].
            "','".$post_data['admin_email_address']."','".password_hash($post_data['admin_password'],PASSWORD_BCRYPT)."')";
        $db->insert($sql);

        return true;
    }

    public function logout(){
        session_unset();
        session_destroy();
        header('Location: index.php');
    }

    public function is_logged_in(){
        return $this->is_logged_in;
    }

    public function get_login_error_message(){
        return $this->failed_login_message;
    }

    public function get_sacco(){
        if($this->is_logged_in()){
            $db = new Database();
            $sql = "SELECT `name`, `description` FROM `tbl_saccos` WHERE `id`= '".$_SESSION['sacco_id']."'";
            return $db->select($sql)[0];
        }else{
            return null;
        }
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}

?>