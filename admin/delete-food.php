<?php
    //Include Conctants.php
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Get ID and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the image if available
        if($image_name != "")
        {
            //Get the image path
            $path = "../images/food/".$image_name;

            //Remove image file from Folder
            $remove = unlink($path);

            //Check whether image is removed or not
            if($remove == FALSE)
            {
                //Create a Session Variable to Display Message
                $_SESSION['upload'] = '<div class="error">Failed to remove image.</div>';

                //Redirect Page
                header('location:'.SITEURL.'admin/manage-admin.php');

                //Stop the process
                die();
            }
        }

        //Delete food from DB
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the Query is execeuted or nor
        if($res == TRUE)
        {
            //Create a Session Variable to Display Message
            $_SESSION['delete'] = '<div class="success">Food deleted Successfully.</div>';

            //Redirect Page
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Create a Session Variable to Display Message
            $_SESSION['delete'] = '<div class="error">Failed to delete Food.</div>';

            //Redirect Page
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else
    {
        //Create a Session Variable to Display Message
        $_SESSION['unauthorize'] = '<div class="error">Unauthorized Access.</div>';

        //Redirect Page
        header('location:'.SITEURL.'admin/add-food.php');
    }

?>