<?php  include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login" >
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                //Check whether there is a login message
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <?php 
                //Check whether user is logged in.
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <!-- LOGIN FORM START HERE -->
            <form action="" method="post" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder='Enter username'> <br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>

            </form>
            <!-- LOGIN FORM ENDS HERE -->

            <p class="text-center">Created by - <a href="www.Robbieveivers.com">Robbieveivers</a></p>
        </div>
    </body>
</html>

<?php

    // Check Whether the Submit button is clicked or not
    if(isset($_POST['submit'])){
        // Get data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //Check whether username and password match
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // Execute query
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1){
            //User exists
            $_SESSION['login']= "<div class='success'>Login Successful.</div>";
            $_SESSION['user']=$username;
            header('location:'.SITEURL.'admin/');
        }
        else{
            //User not available 
            $_SESSION['login']= "<div class='error text-center'>Username or Password did not match.</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }


?>