<?php include('partials/menu.php'); ?>

        <!-- Main content section starts  -->
        <div class="main-content">
            <div class="wrapper"> 
                <h1>Manage Food</h1>
                <br>
                <br>
<<<<<<< HEAD

                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }
                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['unauthorised'])){
                        echo $_SESSION['unauthorised'];
                        unset($_SESSION['unauthorised']);
                    }
                    if(isset($_SESSION['no-food-found'])){
                        echo $_SESSION['no-food-found'];
                        unset($_SESSION['no-food-found']);
                    }
                
                ?>

                <br><br>

                <!-- Button to add admin -->
                <a href="<?php echo SITEURL ?>admin/add-food.php" class='btn-primary'>Add Food</a>
=======
                <br>

                <!-- Button to add admin -->
                <a href="#" class='btn-primary'>Add Food</a>
>>>>>>> e3a9d253e4e7ff152c12aed3335bcea3f1507b43
                <br>
                <br>
                <br>
                
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
<<<<<<< HEAD
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                        $sql = "SELECT * FROM tbl_food";
                        $res = mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($res);
                        
                        if($count>0){
                            while($rows=mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $price = $rows['price'];
                                $image_name = $rows['image_name'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];
                                ?>
                                <tr>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo $title;?></td>
                                    <td>$<?php echo $price;?></td>
                                    <td>
                                        <?php
                                            if($image_name==""){
                                                //no image
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            else{
                                                //show image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" width="100px">
                                                <?php
                                            }
                                        
                                        ?>
                                    
                                    </td>
                                    <td><?php echo $featured;?></td>
                                    <td><?php echo $active;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id ?>" class='btn-secondary'>Update Food</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name?>" class='btn-danger'>Delete Food</a>
                                    </td>                
                                </tr>


                                <?php
                            }
                        }
                        else{
                            //Food not added in database
                            echo "<tr> <td colspan = '7' class='error> Food not added Yet </td> </tr>";
                        }
                    
                        
                    
                    ?>
=======
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <tr>
                        <td>1.</td>
                        <td>Robbie veivers</td>
                        <td>robbieveivers</td>
                        <td>
                            <a href="#" class='btn-secondary'>Update Admin</a>
                            <a href="#" class='btn-danger'>Delete Admin</a>
                        </td>
                    </tr>


                    <tr>
                        <td>1.</td>
                        <td>Robbie veivers</td>
                        <td>robbieveivers</td>
                        <td>
                            <a href="#" class='btn-secondary'>Update Admin</a>
                            <a href="#" class='btn-danger'>Delete Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>1.</td>
                        <td>Robbie veivers</td>
                        <td>robbieveivers</td>
                        <td>
                            <a href="#" class='btn-secondary'>Update Admin</a>
                            <a href="#" class='btn-danger'>Delete Admin</a>
                        </td>
                    </tr>

>>>>>>> e3a9d253e4e7ff152c12aed3335bcea3f1507b43

                </table>

            </div>
        </div>
        <!-- Main content section ends  -->

<?php include('partials/footer.php'); ?>