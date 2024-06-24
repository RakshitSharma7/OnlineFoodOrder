<?php include('snippets/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br><br>

            <?php

                //Check whether the id is set or not
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];

                    //SQL Query to get all other Details
                    $sql = "SELECT * FROM tbl_category WHERE id=$id";

                    //Execute the Query
                    $res = mysqli_query($conn, $sql);

                    //Count the rows to check whether the id is valid or not
                    $count = mysqli_num_rows($res);

                    if($count == 1)
                    {
                        //Get all the data
                        $row = mysqli_fetch_assoc($res);

                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['no-category-found'] = '<div class="error">Category not Found.</div>';

                        //Redirect Page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }                
                }
                else
                {
                    //Redirect to Manage Category
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            ?>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if($current_image != "")
                                {
                                    //Display the image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width='150px' alt="<?php echo $current_image; ?>">
                                    <?php
                                }
                                else
                                {
                                    //Display the message
                                    echo '<div class="error">Image not Added.</div>';
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured == "Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured == "No") { echo "checked"; } ?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active == "Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active == "No") { echo "checked"; } ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
                            
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Save" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>

            <?php

                if(isset($_POST['submit']))
                {
                    //Get all the values from the form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //Update the image if selected
                    //Check whether image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        //Get the image name
                        $image_name = $_FILES['image']['name'];

                        //Check whether the image is available or not
                        if($image_name != "")
                        {
                            //Upload the new image

                            //Auto Rename the image
                            //Get the extensions of the image
                            $ext = end(explode('.', $image_name));

                            //Rename the image
                            $image_name = "food_category".rand(000, 999).'.'.$ext;

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = '../images/category/'.$image_name;

                            //Upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //Check whether the image is uploaded or not
                            //If the image is not uploaded stop the process and redirect with error message
                            if($upload==FALSE)
                            {
                                //Create a Session Variable to Display Message
                                $_SESSION['upload'] = '<div class="error">Failed to upload image</div>';

                                //Redirect Page
                                header('location:'.SITEURL.'admin/manage-category.php');

                                //Stop the process
                                die();
                            }

                            //Remove the Current Image if available
                            if($current_image != "")
                            {
                                $remove_path = "../images/category/".$current_image;

                                $remove = unlink($remove_path);

                                //Check whether the image is removed or not
                                //If failed to remove display message and stop the process
                                if($remove == FALSE)
                                {
                                    //Create a Session Variable to Display Message
                                    $_SESSION['failed-remove'] = '<div class="error">Failed to Remove Current Image.</div>';

                                    //Redirect Page
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die(); //Stop the Process
                                }
                            }
                        }
                        else
                        {
                            $image_name = $current_image;
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                    //Update the DB
                    $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
                    ";

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether the Query executed or not
                    if($res2 == TRUE)
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['update'] = '<div class="success">Category Updated Successfully.</div>';

                        //Redirect Page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['update'] = '<div class="error">Failed to Update Category.</div>';

                        //Redirect Page
                        header('location:'.SITEURL.'admin/add-category.php');
                    }
                }
            
            ?>

        </div>
    </div>

<?php include('snippets/footer.php') ?>