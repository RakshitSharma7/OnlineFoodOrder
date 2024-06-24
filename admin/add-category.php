<?php include('snippets/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);    //Removing Session Message
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);    //Removing Session Message
                }
            ?>

            <br><br>

            <!-- Add Category form Starts -->
            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Enter the Category Title"></td>
                    </tr>

                    <tr>
                        <td>Upload Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                        
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Save" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>
            <!-- Add Category form Starts -->

            <?php
                //Check whether the submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //Get the value from Category form
                    $title = $_POST['title'];

                    //Check whether the radio button is selected or not
                    if(isset($_POST['featured']))
                        $featured = $_POST['featured'];     //Get the value
                    else
                        $featured = 'No';       //Set the default value

                    if(isset($_POST['active']))
                        $active = $_POST['active'];     //Get the value
                    else
                        $active = 'No';     //Set the default value

                    //Check whether the image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        //Upload the image
                        //To upload the image we need image name, source path and destination path
                        $image_name = $_FILES['image']['name'];

                        //Upload the image only if image is selected
                        if($image_name != "")
                        {
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
                                $_SESSION['add'] = '<div class="error">Failed to upload image</div>';

                                //Redirect Page
                                header('location:'.SITEURL.'admin/add-category.php');

                                //Stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        //No image uploaded. Set image name as NULL
                        $image_name = '';
                    }
                
                    //SQL Query to insert Categroy into DB
                    $sql = "INSERT INTO tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                    ";

                    //Execute the Query
                    $res = mysqli_query($conn, $sql);

                    //Check whether the Query Executed or not
                    if($res==TRUE)
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['add'] = '<div class="success">Category Added Successfully.</div>';

                        //Redirect Page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['add'] = '<div class="error">Failed to add Category.</div>';

                        //Redirect Page
                        header('location:'.SITEURL.'admin/add-category.php');
                    }
                }
            ?>

        </div>
    </div>

<?php include('snippets/footer.php'); ?>