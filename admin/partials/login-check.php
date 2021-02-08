<?php 
    // Authorization - Access Control
    // Check whether user is logged in or not
    if(!isset($_SESSION['user'])){ // If user session it not set
        //User not logged in Redirect to login page

        $_SESSION['no-login-message'] = "<div class='error text-center'> Please Login to access the Admin Panel.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
    

?>