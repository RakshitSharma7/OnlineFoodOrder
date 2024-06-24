<?php
    
    include('snippets/menu.php');
    
    //Check whether id is set or not
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query ro get the selected folder
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        //Execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Check whether the Query is Executed or not

        //Get the value based on Query Executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get individual values of selected row
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
        //Redirect to Manage Food Page
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">

                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if($current_image == "")
                                {
                                    echo "<div class='error'>Image Not Available.</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px" alt="<?php echo $current_image; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>

                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">

                                <?php
                                    //SQL Query to get active categories
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                    //Execute the Query
                                    $res = mysqli_query($conn, $sql);

                                    //Count rows
                                    $count = mysqli_num_rows($res);

                                    //Check whether category available or not
                                    if($count>0)
                                    {
                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                            $category_title = $row['title'];
                                            $category_id = $row['id'];

                                            //echo "<option value='$category_id'>$category_title</option>";
                                            ?>
                                            <option value="<?php echo $category_id; ?>" <?php if($current_category == $category_id) { echo "selected"; } ?> ><?php echo $category_title; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<option value='0'>Category Not Available.</option>";
                                    }
                                ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes" <?php if($featured == "Yes") { echo "checked"; } ?> >Yes
                            <input type="radio" name="featured" value="No" <?php if($featured == "No") { echo "checked"; } ?>>No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes" <?php if($active == "Yes") { echo "checked"; } ?> >Yes
                            <input type="radio" name="active" value="No" <?php if($active == "No") { echo "checked"; } ?> >No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="submit" name="submit" value="submit" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>

            <?php

                if(isset($_POST['submit']))
                {
                    //Get all the Details from the form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //Check whether the submit button is clicked or not
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];

                        //Check whether the fie is available or not
                        if($image_name != "")
                        {
                            //Upload the new image

                            //Auto Rename the image
                            //Get the extensions of the image
                            // $ext = end(explode('.', $image_name));

                            // //Rename the image
                            // $image_name = "food_name".rand(0000, 9999).'.'.$ext;

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = '../images/food/'.$image_name;

                            //Upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //Check whether the image is uploaded or not
                            //If the image is not uploaded stop the process and redirect with error message
                            if($upload == FALSE)
                            {
                                //Create a Session Variable to Display Message
                                $_SESSION['upload'] = '<div class="error">Failed to upload image</div>';

                                //Redirect Page
                                header('location:'.SITEURL.'admin/manage-food.php');

                                //Stop the process
                                die();
                            }

                            //Remove the Current Image if available
                            if($current_image != "")
                            {
                                $remove_path = "../images/food/".$current_image;

                                $remove = unlink($remove_path);

                                //Check whether the image is removed or not
                                //If failed to remove display message and stop the process
                                if($remove == FALSE)
                                {
                                    //Create a Session Variable to Display Message
                                    $_SESSION['remove-failed'] = '<div class="error">Failed to Remove Current Image.</div>';

                                    //Redirect Page
                                    header('location:'.SITEURL.'admin/manage-food.php');
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

                    //Updaet the food in DB
                    $sql3 = "UPDATE tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                    ";

                    //Execute the Query
                    $res3 = mysqli_query($conn, $sql3);

                    //Check whether the Query is Executed or not
                    if($res3 == TRUE)
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['update'] = '<div class="success">Food Updated Successfully.</div>';

                        //Redirect Page
                        // header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['remove-failed'] = '<div class="error">Failed to Update Food.</div>';

                        //Redirect Page
                         header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }

            ?>

        </div>
    </div>

<?php include('snippets/footer.php') ?>