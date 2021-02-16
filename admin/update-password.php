<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <br><br>

        <?php
            if(isset($_GET['id'])){
                $id=$_GET['id'];
            }

        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Old Password: </td>
                <td><input type="password" name="current_password" placeholder="Old password"></td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td><input type="password" name="new_password" placeholder="New password"></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input type="password" name="confirm_password" placeholder="Confirm password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value=<?php echo $id?>>
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>
        </table>


        </form>
    </div>
</div>


<?php

            // Check whether the submit button is clicked
            if(isset($_POST['submit'])){

                //1. Get data from the form
                $id=$_POST['id'];
                $current_password= md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);

                //2. Check whether the user with current id and password exists or not
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
                //Execute the query
                $res = mysqli_query($conn, $sql);

                //3. Check whether the new password and confirm password match or not
                if($res==TRUE){
                    //Check whether data is avaiable or not
                    $count=mysqli_num_rows($res);
                    if($count==1){
                        //User exists and password can be change
                        //echo "user found";
                        //Check whether new password and confirm password match
                        if($new_password==$confirm_password){
                            //update password
                            $sql2="UPDATE tbl_admin SET
                                password='$new_password'
                                WHERE id=$id";

                            //Execute
                            $res2 = mysqli_query($conn, $sql2);
                            //Check if was successful
                            if($res2==true){
                                //redirect to manage admin page with success message
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                                //Redirect page to manage admin
                                header("location:".SITEURL.'admin/manage-admin.php');
                            }
                            else{
                                //redirect to manage admin page with error message
                                $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                                //Redirect page to manage admin
                                header("location:".SITEURL.'admin/manage-admin.php');
                            }
                        }
                        else{
                            //redirect to manage admin page with error message
                        $_SESSION['pwd-not-matched'] = "<div class='error'>Password did not match. </div>";
                        //Redirect page to manage admin
                        header("location:".SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else{
                        //user does not exist set message and redirect
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                        //Redirect page to manage admin
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                }

                //4. Change password if all above is true
            }

?>



<?php include('partials/footer.php'); ?>