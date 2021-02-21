<?php include('partials/menu.php'); 
    // Get the id of the category being updated
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    else{
        header('location;'.SITEURL.'admin/manage-category,php');
    }
    // Getting current data for the category being edited
    $sql = "SELECT * FROM tbl_category WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count==1){
        //Get all the data
        $row = mysqli_fetch_assoc($res);
    }
    else{
        //Redirect to manage category with system message
        $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');

    }
    
?>

<div class='main-content'>
    <div class='wrapper'>
        <h1>Update Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['edit'])){
                echo $_SESSION['edit'];
                unset($_SESSION['edit']); // Returning value
            }


        ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $row['title']; ?> "></td>
                </tr>

                <tr>
                    <td>Image:</td>
                    <td>
                                        <?php
                                            //Check whether image name is avaiable
                                            if($row['image_name']!=''){
                                                // Display message
                                                ?>
                                                <img src="<?php echo SITEURL.'images/category/'.$row['image_name'];?>" width="100px" alt="">
                                                <?php
                                            }
                                            else{
                                                // Display message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                        ?>
                                    </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($row['featured']=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($row['featured']=="No"){echo "checked";}?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <?php ?>
                        <input <?php if($row['active']=="Yes"){echo "checked";}?> type="radio" name="active" value='Yes'> Yes
                        <input <?php if($row['active']=="No"){echo "checked";}?> type="radio" name="active" value='No'> No
                    </td>
                </tr>

                <tr>
                    <td colspan="3 ">
                        <input type="hidden" name='current_image' value="<?php echo $row['image_name']; ?>">
                        <input type="hidden" name='id' value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

    //Process the Value from Form and save it in Database

    //Check Whether the submit buttons is clicked or not

    if(isset($_POST['submit']))
    {
        //Button CLicked
        //echo "Button Clicked";

        //1. Get Data from form
        $title = $_POST['title'];
        $id = $_POST['id'];  
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //2. Updating new Image if Selected
        //$sql2 = ''
        if(isset($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];

            if($image_name !=""){
                //Image Available
                //Upload new image
                    //Get the extention type of the image
                    $extention_type = end(explode('.', $image_name));
                    $image_name = $image_name.rand(000, 999).'.'.$extention_type;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;
                    //Upload Image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Check whether the image is uploaded or not.
                    //If the image is not uploaded then stop process and send error message
                    if($upload==false){
                        //Set Message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                        header('loacation:'.SITEURL.'admin/manange-category.php');
                        die();

                    }
                    if($current_image!=""){
                                                //Remove old image
                        $remove_path = '../images/category/'.$current_image;
                        $remove = unlink($remove_path);
                        if($remove==false){
                            //failed to delete image
                            $_SESSION['remove'] = "<div class='error'>Image Failed to Delete.</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }
                    }

            }
            else{
                $image_name = $current_image;

            }
        }
        else{
            $image_name = $current_image;
        }

        //3. Update Database
        $sql2 = "UPDATE tbl_category SET
        title = '$title' ,
        image_name = '$image_name' ,
        featured = '$featured' ,
        active = '$active'
        WHERE id='$id'
        ";

        $res2 = mysqli_query($conn, $sql2);

        //4. Redirect to manage category page

        //3. Executing Query and saving data into database


        //4. CHeck whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res2==TRUE){
            //Data Inserted
            //Create session Variable to display message
            $_SESSION['update'] = "<div class=Success>Category Updated Successfully </div>";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/manage-category.php');
        }
        else{
            //Failed to Insert data
            //echo "failed to insert data";
            //Create session Variable to display message
            $_SESSION['update'] = "<div class=error> Failed to Update Category </div>";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/update-category.php');
        }
    }