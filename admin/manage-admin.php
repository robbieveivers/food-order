<?php include('partials/menu.php'); ?>

        <!-- Main content section starts  -->
        <div class="main-content">
            <div class="wrapper"> 
                <h1>Manage Admin</h1>
                <br>
                <br>
                <br>
                <!-- Displaying Add Admin Message -->
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];  //Displaying message
                        unset($_SESSION['add']); //Removing Admin message
                    }
                ?>
                <!-- Displaying Delete Admin Message -->
                <?php
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];  //Displaying message
                        unset($_SESSION['delete']); //Removing Admin message
                    }
                ?>
                <!-- Displaying Delete Admin Message -->
                <?php
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];  //Displaying message
                        unset($_SESSION['update']); //Removing Admin message
                    }
                ?>
                <!-- Displaying User not found Message -->
                <?php
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];  //Displaying message
                        unset($_SESSION['user-not-found']); //Removing Admin message
                    }
                ?>
                <!-- Displaying User not found Message -->
                <?php
                    if(isset($_SESSION['pwd-not-match'])){
                        echo $_SESSION['pwd-not-match'];  //Displaying message
                        unset($_SESSION['pwd-not-match']); //Removing Admin message
                    }
                ?>
                <!-- Displaying Change password Message -->
                <?php
                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd'];  //Displaying message
                        unset($_SESSION['change-pwd']); //Removing Admin message
                    }
                ?>


                <br><br><br>

                <!-- Button to add admin -->
                <a href="add-admin.php" class='btn-primary'>Add Admin</a>
                <br>
                <br>
                <br>
                
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        // Query to receive all admin data
                        $sql = "SELECT * FROM tbl_admin";
                        // Execute the Query
                        $res = mysqli_query($conn, $sql);

                        //Check whether the Query is executed
                        if($res==TRUE){
                            //count rows to see whether we have data in the database
                            $count = mysqli_num_rows($res); // Get all the rows in database

                            //Check the number of rows
                            if($count>0){
                                //Data in database
                                while($rows=mysqli_fetch_assoc($res)){
                                    //Using While loop to get all the data from data base
                                    // and while loop will execute as long as there is data

                                    //Get individual Data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Display the values in our table
                                    ?>
                                    
                                        <tr>
                                            <td><?php echo $id; ?>.</td>
                                            <td><?php echo $full_name; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class='btn-primary'>Change Password</a>
                                                <a href="<?php echo SITEURL; ?>admin/edit-admin.php?id=<?php echo $id; ?>" class='btn-secondary'>Update Admin</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class='btn-danger'>Delete Admin</a>
                                            </td>
                                        </tr>
                                    
                                    
                                    <?php

                                }
                            }
                            else{
                                //No data in database
                            }
                        }

                    ?>

                </table>
            </div>
        </div>
        <!-- Main content section ends  -->

<?php include('partials/footer.php'); ?>