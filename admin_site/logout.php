<?php

include('php/User.inc.php');

$user = new User();
if($user->is_logged_in()){
    $user->logout();
}else{
    header('Location: index.php');
}

?>