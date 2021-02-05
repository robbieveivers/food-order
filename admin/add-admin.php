<?php include('partials/menu.php'); ?>

<div class='main-content'>
    <div class='wrapper'>
        <h1>Add Admin</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']); // Returning value
            }

        ?>
        <form action="" method="POST">

            <table class='tbl-30'>
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Username"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>

                <tr>
                    <td colspan="2 ">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
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
        $password = md5($_POST['password']); //Password Encryption with MD5

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        //3. Executing Query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. CHeck whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //Data Inserted
            //echo "Data inserted";
            //Create session Variable to display message
            $_SESSION['add'] = "Admin Added Successfully";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //Failed to Insert data
            //echo "failed to insert data";
            //Create session Variable to display message
            $_SESSION['add'] = "Failed to Add Admin";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }

?>