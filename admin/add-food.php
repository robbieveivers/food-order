<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td> 
                        <textarea name="description" cols="30" rows="6" placeholder="Description of the food"></textarea>   
                    </td>
                
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="num" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Catergory</td>
                    <td>
                        <select name="category">
                            <?php 
                                //Create Php code to display catergorys from db
                                //1. Create SQL Query. Only active Category's
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res = mysqli_query($conn,$sql);
                                //2. Display on dropdown
                                if($res==true){
                                    $count=mysqli_num_rows($res);
                                    if($count>0){
                                        while($rows=mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $title =$rows['title'];

                                            ?> 
                                            <option value="<?php echo $id; ?>"> <?php echo $title; ?> </option>
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
                    <td>Featured:</td>
                    <td><input type="radio" name="featured" value="Yes">Yes</td>
                    <td><input type="radio" name="featured" value="No">No</td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td><input type="radio" name="active" value="Yes">Yes</td>
                    <td><input type="radio" name="active" value="No">No</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Food" name="submit" class="btn-secondary">
                    </td>
                
                </tr>
            </table>
        
        </form>

    
    </div>
</div>

<?php 
    // Button is clicked
    if(isset($_POST['submit'])){
        //1. Get data from form
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }
        else{
            $featured = "No"; //Default Value is No
        }

<<<<<<< HEAD
=======

>>>>>>> e3a9d253e4e7ff152c12aed3335bcea3f1507b43
        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }
        else{
            $active = "Yes"; // Default Value is Yes
        }


        //2. Upload image if selected
        if(isset($_FILES['image']['name'])){
            //Get the details of the image
            $image_name = $_FILES['image']['name'];

            //Check whether actual image is selected or not and upload
            if($image_name!=""){
                $extension = end(explode('.',$image_name));
                $image_name = $image_name.rand(0,999).".".$extension;
                $source_path = $_FILES['image']['tmp_name'];
                $destination = "../images/food/".$image_name;
                $upload = move_uploaded_file($source_path, $destination);
                if($upload==false){
                    //failed to upload image
                    $_SESSION['upload'] = "<div class='error'> Failed to Upload image.</div>";
                    header('location'.SITEURL.'admin/add-food.php');

                    die();
                }
            }
        }
        else{
            $image_name = ""; // Default Value is Blank
        }

        //3. Insert Into Database
        $sql2 = "INSERT INTO tbl_food SET
            title = '$title',
            description ='$description',
            price = $price,
            image_name = '$image_name',
            category_id= $category,
            featured = '$featured',
            active = '$active'
        ";
        $res2 = mysqli_query($conn, $sql2);
        if($res2==true){
            //data inserted
            $_SESSION['add'] = "<div class='success'> Food Added Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            //failed to upload data
            $_SESSION['add'] = "<div class='error'> Food failed to be Added.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }


        //4. Redirect with message to Manage food page

    }
?>

<?php include('partials/footer.php')?>

