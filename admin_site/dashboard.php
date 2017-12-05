<?php

    include('php/User.inc.php');

    function flash_message(){
        if(isset($_SESSION['flash_message'])){
            $success="<div class='ui positive icon message'>
                    <i class='check icon'></i>
                    <div class='content'>
                        <div class='header'>Successful data update</div>
                        <p>".$_SESSION['flash_message']."</p>
                    </div>
                 </div>";
            unset($_SESSION['flash_message']);
            return $success;
        }
        return null;
    }

    $user = new User();
    if($user->is_logged_in()){
        include('html/Page.inc.php');
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_POST['sacco_buses_add'])){
                $db = new Database();
                $sql="INSERT INTO `tbl_buses`(`plate`, `capacity`, `sacco_id`, `route_number`)
VALUES ('".$_POST['sacco_bus_plate']."','".$_POST['sacco_bus_capacity']."','".$_SESSION['sacco_id']."','".$_POST['sacco_bus_route_number']."')";
                $db->insert($sql);
                $_SESSION['flash_message']="You have successfully added the bus record.";
                header('Location: index.php');
            }

            if(isset($_POST['sacco_bus_operation'])){
                if(isset($_POST['sacco_bus_delete'])){
                    $db = new Database();
                    $sql = "DELETE FROM `tbl_buses` WHERE `id`='".$_POST['sacco_bus_id']."'";
                    $db->delete($sql);
                    $_SESSION['flash_message']="You have successfully deleted the bus record.";
                    header('Location: index.php');
                }
                if(isset($_POST['sacco_bus_update'])){
                    $_SESSION['sacco_bus_id'] = $_POST['sacco_bus_id'];
                    header('Location: bus_update.php');
                }
                if(isset($_POST['sacco_bus_assign'])){
                    $_SESSION['sacco_bus_id'] = $_POST['sacco_bus_id'];
                    header('Location: bus_assign.php');
                }
            }

            if(isset($_POST['sacco_drivers_add'])){
                $db = new Database();
                $sql="INSERT INTO `tbl_drivers`(`sacco_id`, `first_name`, `last_name`, `phone_number`, `drivers_license`)
VALUES ('".$_SESSION['sacco_id']."','".$_POST['sacco_driver_first_name']."','".$_POST['sacco_driver_last_name']."','".$_POST['sacco_driver_phone_number']."','".$_POST['sacco_driver_license']."')";
                $db->insert($sql);
                $_SESSION['flash_message']="You have successfully added the driver record.";
                header('Location: index.php');
            }

            if(isset($_POST['sacco_driver_operation'])){
                if(isset($_POST['sacco_driver_delete'])){
                    $db = new Database();
                    $sql = "DELETE FROM `tbl_drivers` WHERE `driver_id`='".$_POST['sacco_driver_id']."'";
                    $db->delete($sql);
                    $_SESSION['flash_message']="You have successfully deleted the driver record.";
                    header('Location: index.php');
                }
                if(isset($_POST['sacco_driver_update'])){
                    $_SESSION['sacco_driver_id'] = $_POST['sacco_driver_id'];
                    header('Location: driver_update.php');
                }
                if(isset($_POST['sacco_driver_deassign'])){
                    $db = new Database();
                    $sql = "UPDATE `tbl_drivers` 
SET `has_assigned_bus`=NULL WHERE `driver_id`='".$_POST['sacco_driver_id']."'";
                    $db->update($sql);
                    $_SESSION['flash_message']="You have successfully deassigned the driver from the bus.";
                    header('Location: index.php');
                }
            }

        }else{

            $sacco_name=$user->get_sacco()->name;
            $success = flash_message();

            $db = new Database();
            $sql="SELECT `id`,`plate`, `capacity`, `route_number` FROM `tbl_buses` WHERE `sacco_id`='".$_SESSION['sacco_id']."'";
            $sacco_buses=$db->select($sql);

            $sql="SELECT `driver_id`,`first_name`, `last_name`, `phone_number`, `drivers_license`,`has_assigned_bus` FROM `tbl_drivers` WHERE `sacco_id`='".$_SESSION['sacco_id']."'";
            $sacco_drivers = $db->select($sql);

            $page = new Page('dashboard_content.php');
            $page->show(compact('sacco_name','success','sacco_buses','sacco_drivers'));
        }

    }else{
        header('Location: index.php');
    }
?>