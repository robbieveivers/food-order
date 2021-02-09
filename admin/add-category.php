<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add-category'])){
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <!-- Add Category form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr> 
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value='Yes'> Yes
                        <input type="radio" name="active" value='No'> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn-secondary" name="submit" value="Add Category">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Category form ends -->
        <?php 
            //Check whether the submit button is clicked or not
            if(isset($_POST['submit'])){
                //Button has been clicked.
                
                //1. get the value from catergory form
                $title=$_POST['title'];

                //For radio type I need to check whether the button is selected or not.
                if(isset($_POST['featured'])){
                    // Get value from form
                    $featured=$_POST['featured'];

                }
                else{
                    // Set the default value
                    $featured='No';
                }

                if(isset($_POST['active'])){
                    // Get Value from form
                    $active = $_POST['active'];
                }
                else{
                    $active = 'No';
                }
                // Check whether image is selected
                // print_r($_FILES['image']);
                // die();
                ///////////////////////////////ADD DATE TIME AUTO RENAME SO THERE IS NEVER OVERRIDE FILES
                if(isset($_FILES['image']['name'])){
                    //Upload Image, To upload image, Need name and Source path and Destiation path
                    $image_name = $_FILES['image']['name'];
                    // Auto Renaming the image for database storage
                    if($image_name !=""){
                        // Get the extention type of the image
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
                            header('loacation:'.SITEURL.'admin/add-category.php');
                            die();

                        }
                    }


                }
                else{
                    //Don't upload image and set Image value to blank
                    $image_name = '';

                }

                //2. Create sql query to insert data into database
                $sql = "INSERT INTO tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'";

                //3. Execute sql query
                $res = mysqli_query($conn, $sql);

                //4. Check whether the query executed or not and data added or not.
                if($res==true){
                    //data was executed
                    $_SESSION['add-category'] = "<div class='success'>Category Added Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    //failed to data catergory
                    $_SESSION['add-category'] = "<div class='error'>Failed to add category</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>

    </div>

</div>






<?php include('partials/footer.php');?>