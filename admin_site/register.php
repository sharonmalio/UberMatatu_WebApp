<?php

    if($_SERVER['REQUEST_METHOD']=="POST"){
        include('php/User.inc.php');
        $user = new User();
        $user->register($_POST);
        header('Location: index.php');
    }else{
        include('html/Page.inc.php');
        $page = new Page('register_content.php');
        $page->show();
    }
?>