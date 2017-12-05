<?php

include('html/Page.inc.php');
include('php/User.inc.php');

$user = new User();
if($user->is_logged_in()){

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $db = new Database();
        $sql="UPDATE `tbl_buses` 
SET `plate`='".$_POST['sacco_bus_plate']."',`capacity`='".$_POST['sacco_bus_capacity']."', `route_number`='".$_POST['sacco_bus_route_number']."', `assigned_driver`='".$_POST['sacco_bus_driver']."' WHERE `id`='".$_POST['sacco_bus_id']."'";
        $db->update($sql);

        $sql="UPDATE `tbl_drivers` 
SET `has_assigned_bus`=".true." WHERE `driver_id`='".$_POST['sacco_bus_driver']."'";
        $db->update($sql);

        $_SESSION['flash_message']="You have successfully updated the bus record.";
        header('Location: dashboard.php');
    }

    if(isset($_SESSION['sacco_bus_id'])){
        $bus_id = $_SESSION['sacco_bus_id'];
    }else{
        header('Location: dashboard.php');
    }
    unset($_SESSION['sacco_bus_id']);

    $db=new Database();
    $sql="SELECT `id`, `plate`, `capacity`, `sacco_id`, `route_number` FROM `tbl_buses` WHERE `id`='".$bus_id."'";
    $bus=$db->select($sql)[0];

    $sql="SELECT `driver_id`, `sacco_id`, `first_name`, `last_name`, `phone_number`, `drivers_license`, `has_assigned_bus` FROM `tbl_drivers` WHERE `has_assigned_bus` IS NULL";
    $free_drivers = $db->select($sql);

    $page = new Page('bus_assign_content.php');
    $page->show(compact('bus','free_drivers'));

}else{
    header('Location: index.php');
}

?>