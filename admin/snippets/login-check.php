<?php
    //Authorization - Access Control
    //Check whether the user is logged in or not
    if(!isset($_SESSION['user']))
    {
        //User not Logged in
        //Redirect to Login Page
        $_SESSION['no-login-msg'] = '<div class="error text-center">Authorization Required to access Admin Panel.</div>';

        header('location:'.SITEURL.'admin/login.php');
    }
?>