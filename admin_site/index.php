<?php

    include('php/User.inc.php');

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $user = new User();
        $user->login($_POST);

        if($user->is_logged_in()){
            header('Location: dashboard.php');
        }else{
            $login_error_message = $user->get_login_error_message();
            include('html/Page.inc.php');
            $page = new Page('index_content.php');
            $page->show(compact('login_error_message'));
        }

    }else{
        $user = new User();
        if($user->is_logged_in()){
            header('Location: dashboard.php');
        }else{
            include('html/Page.inc.php');
            $page = new Page('index_content.php');
            $page->show();
        }
    }
?>