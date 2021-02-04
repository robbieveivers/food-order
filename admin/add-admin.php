<?php include('partials/menu.php'); ?>

<div class='main-content'>
    <div class='wrapper'>
        <h1>Add Admin</h1>
        <br><br>
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





        //$res = mysqli_query($conn, $sql) or die(mysqli_error());
    }

?>