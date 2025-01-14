<?php include('snippets/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br><br>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);    //Removing Session Message
                }
            ?>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="full_name" placeholder="Enter Full Name" required></td>
                    </tr>

                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" placeholder="Enter Username" required></td>
                    </tr>

                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" placeholder="Enter Password" required></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Save" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>

<?php include('snippets/footer.php'); ?>

<?php
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Get Data from Form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);    //Password Encryption with MD5(One way Encryption, Cannot Decrypt)

        //SQL Query to save the data into Database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        //Execute Query
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Check whether the Query is executed or not
        if($res==TRUE)
        {
            //Create a Session Variable to Display Message
            $_SESSION['add'] = '<div class="success">Admin Added Successfully</div>';

            //Redirect Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Create a Session Variable to Display Message
            $_SESSION['add'] = '<div class="error">Failed to Add Admin</div>';

            //Redirect Page
            header('location:'.SITEURL.'admin/add-admin.php');
        }
    }
?>