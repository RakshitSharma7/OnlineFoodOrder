<?php
    include('../config/constants.php');

    ////Check whwether the id and image name is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the image file if available
        if($image_name != "")
        {
            $path = "../images/category/".$image_name;

            //Remove the image
            $remove = unlink($path);

            //If failed to remove image then add an error message and stop the process
            if($remove == false)
            {
                //Set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to Delete Image.</div>";

                //Redirect to Manage Category Page
                header('location:'.SITEURL.'admin/manage-category.php');

                //Stop the process
                die();
            }
        }

        //Delete Data from DB
        //SQL Query to delete data from DB
        $sql = "DELETE FROM tbl_category WHERE id = $id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether data is deleted fom DB
        if($res == true)
        {
            //Create a Session Variable to Display Message
            $_SESSION['delete'] = '<div class="success">Category Deleteed Successfully.</div>';

            //Redirect Page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Create a Session Variable to Display Message
            $_SESSION['delete'] = '<div class="error">Failed to Delete Category.</div>';

            //Redirect Page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        //Redirect to Manage Category Page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>