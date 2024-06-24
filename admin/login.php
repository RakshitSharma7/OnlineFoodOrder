<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>wowFood</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1><br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-msg']))
                {
                    echo $_SESSION['no-login-msg'];
                    unset($_SESSION['no-login-msg']);
                }
            ?>

            <br><br>

            <form action="" method="POST" class="text-center">

                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>

            </form>

            <p class="text-center">Created By - <a href="http://localhost/Online-Food-Order/">Rakshit</a></p>
        </div>

    </body>
</html>

<?php
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Process for Login
        //Get the Data from Login here
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        //SQL Query to check whether the user with username and password exists
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Count rows to check whether user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //Create a Session Variable to Display Message
            $_SESSION['login'] = '<div class="success">Login Successfull.</div>';

            $_SESSION['user'] = $username;  //To check whether user is logged in or not

            //Redirect Page
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //Create a Session Variable to Display Message
            $_SESSION['login'] = '<div class="error text-center">Login Failed.</div>';

            //Redirect Page
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>