<?php
    //Include constants.php file here
    include('../config/constants.php');

    // 1. Get the id of the admin to be deleted
    $id = $_GET['id'];

    // 2. create sql query to delete admin

    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    // Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query was executed successfully or not
    if($res==true){
        // Query was success and admin deleted
        $_SESSION['delete']="<div class='success'> Admin Deleted Successfully </div>";
    
    }
    else{
        //Failed to delete
        $_SESSION['delete']="<div class='error'>Failed to Delete Admin. Try again Later. </div>";
    }

    // 3. Redirect to manage admin page, with message, Success or Error
    header("location:".SITEURL.'admin/manage-admin.php');


?>