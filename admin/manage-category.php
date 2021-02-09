<?php include('partials/menu.php'); ?>

        <!-- Main content section starts  -->
        <div class="main-content">
            <div class="wrapper"> 
                <h1>Manage Category</h1>
                <br>
                <br>
                <br>
                <!-- Display system Message -->
                <?php 
                    if(isset($_SESSION['add-category'])){
                        echo $_SESSION['add-category'];
                        unset($_SESSION['add-category']);
                    }
                ?>
                <br><br>

                <!-- Button to add admin -->
                <a href="<?php echo SITEURL;?>admin/add-category.php" class='btn-primary'>Add Category</a>
                <br>
                <br>
                <br>
                
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php 

                    $sql = "SELECT * FROM tbl_category";

                    $res = mysqli_query($conn, $sql);

                    if($res==true){
                        $count = mysqli_num_rows($res);

                        if($count>0){
                            while($rows=mysqli_fetch_assoc($res)){
                                $id=$rows['id'];
                                $title=$rows['title'];
                                $image_name=$rows['image_name'];
                                $featured=$rows['featured'];
                                $active=$rows['active'];
                                ?>
                                <tr>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo $title;?></td>

                                    <td>
                                        <?php
                                            //Check whether image name is avaiable
                                            if($image_name!=''){
                                                // Display message
                                                ?>
                                                <img src="<?php echo SITEURL.'images/category'.$image_name;?>" width="100px" alt="">
                                                <?php
                                            }
                                            else{
                                                // Display message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $featured;?></td>
                                    <td><?php echo $active;?></td>
                                    <td>
                                        <a href="#" class='btn-secondary'>Update Category</a>
                                        <a href="#" class='btn-danger'>Delete Category</a>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        else{
                            //No Data to Display
                            ?>
                            <tr>
                                <td colspan='6'><div class="error">No Category Added</div></td>
                            </tr>
                            <?php
                        }
                    }



                    
                    
                    ?>

                </table>

            </div>
        </div>
        <!-- Main content section ends  -->

<?php include('partials/footer.php'); ?>