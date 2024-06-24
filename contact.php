<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="Stylesheet" href="css/contact.css"/>
    <title>wowFood</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="left-side">
                <div class="address details">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="topic">Address</div>
                    <div class="text-one">Global Foods</div>
                    <div class="text-two">WhiteField, Bangalore Urban, Karnataka-560066</div>
                </div>
                <div class="phone details">
                    <i class="fas fa-phone-alt"></i>
                    <div class="topic">Phone</div>
                    <div class="text-one">+91 8599888888</div>
                    <div class="text-two">+91 7879664422</div>
                </div>
                <div class="email details">
                    <i class="fas fa-envelope"></i>
                    <div class="topic">Email</div>
                    <div class="text-one">contact@globalfoods.in</div>
                    <div class="text-two">info@globalfoods.in</div>
                </div>
            </div>
            <div class="right-side">
                <div class="topic-text">Send Us a Message</div>
                <p>If you have any queries, you can send us a message from here.</p>
                <form action="" method="POST">
                    <div class="input-box">
                        <input type="text" name="name" placeholder="Enter your name">
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="input-box message-box">
                        <textarea name="message" placeholder="Type Message here"></textarea>
                    </div>
                    <div class="button">
                        <input type="submit" name="submit" value="Send">
                    </div>
                </form>

                <?php
                //Check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //Get all the details from form
                    $status = "Unresolved";
                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $message = mysqli_real_escape_string($conn, $_POST['message']);

                    //SQL Query to save the Data into DB
                    $sql = "INSERT INTO tbl_query SET
                        name = '$name',
                        email = '$email',
                        status = '$status',
                        message = '$message'
                    ";

                    //Execute the Query
                    $res = mysqli_query($conn, $sql);

                    //Check whether Query Executed or not
                    if($res == TRUE)
                    {
                        $_SESSION['contact'] = "<div class='success text-center'>Thank you for your Feedback. We'll get back to you soon.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['contact'] = "<div class='error text-center'>Sorry! Please try again later.</div>";
                        header('location:'.SITEURL);
                    }
                }
                ?>

            </div>
        </div>
    </div>
</body>
</html>