<?php
    //Include constants.php file here
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //Get value and delete
        $id= $_GET['id'];
        $image_name=$_GET['image_name'];
        //Delete image if avaiable
        if($image_name!=""){
            // Remove image
            $path = '../images/category/'.$image_name;
            $remove = unlink($path);
            if($remove==false){
                //failed to delete image
                $_SESSION['remove'] = "<div class='error'>Image Failed to Delete.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }
        // 2. create sql query to delete category

        $sql = "DELETE FROM tbl_category WHERE id=$id";
        // Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query was executed successfully or not
        if($res==true){
            // Query was success and Category deleted
            $_SESSION['delete']="<div class='success'> Category Deleted Successfully </div>";
        
        }
        else{
            //Failed to delete
            $_SESSION['delete']="<div class='error'>Failed to Delete Category. Try again Later. </div>";
        }

        // 3. Redirect to manage admin page, with message, Success or Error
        header("location:".SITEURL.'admin/manage-category.php');

    }
    else{
        //redirect to manage category page
        header("location:".SITEURL.'admin/manage-category.php');
    }




?>