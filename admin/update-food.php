<?php include('partials/menu.php'); 
    // Get the id of the food being updated
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    else{
        header('location;'.SITEURL.'admin/manage-food.php');
    }
    // Getting current data for the food being edited
    $sql = "SELECT * FROM tbl_food WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count==1){
        //Get all the data
        $row = mysqli_fetch_assoc($res);
    }
    else{
        //Redirect to manage food with system message
        $_SESSION['no-food-found'] = "<div class='error'>Food not Found.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

    }
    
?>

<div class='main-content'>
    <div class='wrapper'>
        <h1>Update Food</h1>
        <br><br>

        <?php
            if(isset($_SESSION['edit'])){
                echo $_SESSION['edit'];
                unset($_SESSION['edit']); // Returning value
            }


        ?>
        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $row['title'];?>">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td> 
                        <textarea name="description" cols="30" rows="6"><?php echo $row['description']; ?></textarea>   
                    </td>
                
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="num" name="price" value="<?php echo $row['price'];?>">
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <?php
                            //Check whether image name is avaiable
                            if($row['image_name']!=''){
                                // Display message
                                ?>
                                <img src="<?php echo SITEURL.'images/food/'.$row['image_name'];?>" width="100px" alt="">
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
                    <td>Catergory</td>
                    <td>
                        <select name="category">
                            <?php 
                                //Create Php code to display catergorys from db
                                //1. Create SQL Query. Only active Category's
                                $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res2 = mysqli_query($conn,$sql2);
                                //2. Display on dropdown
                                if($res2==true){
                                    $count2=mysqli_num_rows($res2);
                                    if($count2>0){
                                        while($rows=mysqli_fetch_assoc($res2)){
                                            $id1 = $rows['id'];
                                            $title1 =$rows['title'];

                                            ?> 
                                            <option <?php if($title1==$id1){echo "selected";} ?> value="<?php echo $id1; ?>"> <?php echo $title1; ?> </option>
                                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                            <option value="0">No Category Found</option>
                                        <?php
                                    }
                                }

                            ?>
                        </select>
                    </td>
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
                    <td colspan="2">

                        <input type="hidden" name='id' value="<?php echo $row['id']; ?>">
                        
                        <input type="hidden" name='current_image' value="<?php echo $row['image_name']; ?>">
                        <input type="submit" value="Update Food" name="submit" class="btn-secondary">
                    </td>
                
                </tr>
            </table>
        </form>

    </div>
</div>

<?php
    
    //Process the Value from Form and save it in Database

    //Check Whether the submit buttons is clicked or not

    if(isset($_POST['submit']))
    {
        //Button CLicked
        //echo "Button Clicked";

        //1. Get Data from form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category']; 
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
                    $end_type = explode('.', $image_name);
                    $extention_type = end($end_type);
                    $image_name = $image_name.rand(000, 999).'.'.$extention_type;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/".$image_name;
                    //Upload Image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Check whether the image is uploaded or not.
                    //If the image is not uploaded then stop process and send error message
                    if($upload==false){
                        //Set Message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                        header('loacation:'.SITEURL.'admin/manange-food.php');
                        die();
                    }
                    if($current_image!=""){
                                                //Remove old image
                        $remove_path = '../images/food/'.$current_image;
                        $remove = unlink($remove_path);
                        if($remove==false){
                            //failed to delete image
                            $_SESSION['remove'] = "<div class='error'>Image Failed to Delete.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
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
        $sql3 = "UPDATE tbl_food SET
            title = '$title',
            description ='$description',
            price = $price,
            image_name = '$image_name',
            category_id= $category,
            featured = '$featured',
            active = '$active'
            WHERE id='$id'
        ";
        $res3 = mysqli_query($conn, $sql3);
        if($res3==true){
            //data inserted
            $_SESSION['add'] = "<div class='success'> Food Updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            //failed to upload data
            $_SESSION['add'] = "<div class='error'> Food failed to be Updated.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }
    }
    include('partials/footer.php');
    ?>