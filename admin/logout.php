<?php
    include('../config/constants.php');

    //Destroy the Session
    session_destroy();  //unsets $_SESSION['user']

    //Redirect to Login Page
    header('location:'.SITEURL.'admin/login.php');
?>