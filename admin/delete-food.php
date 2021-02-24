<?php 

    include('../config/constants.php');

    //1. Check whether values is parsed 
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //Process to delete
        $id = $_GET['id'];
        $image_name= $_GET['image_name'];

        //Remove the image if avaiable
        if($image_name!=""){
            //Get image path
            $path = "../images/food/".$image_name;
            //Remove image file from folder
            $remove = unlink($path);
            //check whether the image was successfully removed
            if($remove==false){
                $_SESSION['upload'] = "<div class='error'>Failed to delete image file.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
            //Delte food from food_tbl
            $sql = "DELETE FROM tbl_food WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            if($res==true){
                $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');

            }
            else{
                $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        }

        
    }
    else{

        $_SESSION['unauthorised'] = "<div class='error'>Unauthorised Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

    }

?>