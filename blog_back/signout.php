<?php
    session_start();
    include "login-class.php";
    $user = new Users();
    $user->user_logout();
    header('location:login.php');
?>