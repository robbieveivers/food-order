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
        <form action="" method="POST" enctype="mulitpart/form-data">

            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="<?php echo $row['title']; ?> "></td>
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
                        <input <?php if($row['active']=="Yes"){echo "checked";}?> type="radio" name="active" value='No'> No
                    </td>
                </tr>

                <tr>
                    <td colspan="3 ">
                        <input type="hidden" name='id' value="<?php echo $id ?>">
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
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $id = $_POST['id'];
       

        //2. SQL Query to Save the data into database
        $sql = "UPDATE tbl_admin SET
            full_name='$full_name',
            username='$username'
            WHERE id='$id'

        ";

        //3. Executing Query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. CHeck whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //Data Inserted
            //echo "Data inserted";
            //Create session Variable to display message
            $_SESSION['update'] = "<div class=Success> Admin Updated Successfully </div>";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/manage-category.php');
        }
        else{
            //Failed to Insert data
            //echo "failed to insert data";
            //Create session Variable to display message
            $_SESSION['update'] = "<div class=error> Failed to Update Admin </div>";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/update-category.php');
        }
    }