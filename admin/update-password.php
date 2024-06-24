<?php include('snippets/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br><br>

            <?php
                if(isset($_GET['id']))
                    $id = $_GET['id'];
            ?>

            <form action="" method="POST">

                <table class="tbl-30">

                    <tr>
                        <td>Current Password: </td>
                        <td><input type="password" name="current_password" placeholder="Enter your Current Password"></td>
                    </tr>

                    <tr>
                        <td>New Password: </td>
                        <td><input type="password" name="new_password" placeholder="Enter your New Password"></td>
                    </tr>

                    <tr>
                        <td>Confirm Password: </td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm your Password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="submit" name="submit" value="Save" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>

        </div>
    </div>

    <?php
        //Check whether the submint button is clicked or not
        if(isset($_POST['submit']))
        {
            //Get the data from the form
            $id = $_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            //Check whether the user with ID and current password exists
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            if($res==TRUE)
            {
                //Check whether data is available or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Check whether new password and confirm password matches or not
                    if($new_password==$confirm_password)
                    {
                        //Update the Password
                        $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id=$id
                        ";

                        //Execute the Query
                        $res2 = mysqli_query($conn, $sql2);
                        
                        //Check whether the Query is Executed or not
                        if($res==TRUE)
                        {
                            //Create a Session Variable to Display Message
                            $_SESSION['change-pwd'] = '<div class="success">Password Changed Successfully.</div>';

                            //Redirect to Manage Admin Page
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                        else
                        {
                            //Create a Session Variable to Display Message
                            $_SESSION['change-pwd'] = '<div class="error">Failed to Change Password.</div>';

                            //Redirect to Manage Admin Page
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['pwd-not-match'] = '<div class="error">Password doesn\'t Match.</div>';

                        //Redirect to Manage Admin Page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    //Create a Session Variable to Display Message
                    $_SESSION['user-not-found'] = '<div class="error">Error! User Not Found.</div>';

                    //Redirect to Manage Admin Page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        }
    ?>

<?php include('snippets/footer.php'); ?>