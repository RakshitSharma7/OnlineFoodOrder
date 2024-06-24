<?php
    //Include constants.php
    include('../config/constants.php');

    //Get the ID of Admin to be deleted
    $id = $_GET['id'];

    //SQL Query to delete the Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    
    //Execute the Query
    $res  = mysqli_query($conn, $sql);

    //Check whether the Executed Successfully or not
    if($res==TRUE)
    {
        //Create Session variable to display
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";

        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
         //Create Session variable to display
         $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";

         //Redirect to Manage Admin Page
         header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>