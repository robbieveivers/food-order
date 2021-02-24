<?php
    include('../config/constants.php');

    //1. Destroy the Session 
    session_destroy();
    unset($_SESSION['user']); //Logouts of 

    //2. Redirect to login page
    header('location:'.SITEURL.'admin/login.php');

?>