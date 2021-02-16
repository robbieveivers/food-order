<?php include('partials/menu.php'); 
    // Get the id of the admin being edited
    $id = $_GET['id'];
?>

<div class='main-content'>
    <div class='wrapper'>
        <h1>Edit Admin</h1>
        <br><br>

        <?php
            if(isset($_SESSION['edit'])){
                echo $_SESSION['edit'];
                unset($_SESSION['edit']); // Returning value
            }

            // Get the value of the admin being editied
            $id = $_GET['id'];

            // Getting current data for the admin being edited
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($res);

        ?>
        <form action="" method="POST">

            <table class='tbl-30'>
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="<?php echo $row['full_name']; ?> "></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="<?php echo $row['username']; ?>"></td>
                </tr>

                <tr>
                    <td colspan="2 ">
                        <input type="hidden" name='id' value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
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
        $id = $_POST['id'];
       

        //2. SQL Query to Save the data into database
        $sql = "UPDATE tbl_admin SET
            full_name='$full_name',
            username='$username'
            WHERE id='$id'

        ";

        //3. Executing Query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. CHeck whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //Data Inserted
            //echo "Data inserted";
            //Create session Variable to display message
            $_SESSION['update'] = "<div class=Success> Admin Updated Successfully </div>";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //Failed to Insert data
            //echo "failed to insert data";
            //Create session Variable to display message
            $_SESSION['update'] = "<div class=error> Failed to Update Admin </div>";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }