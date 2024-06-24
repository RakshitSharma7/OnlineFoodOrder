<?php include('snippets/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br><br>

            <?php
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);    //Removing Session Message
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">

                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Title of Food"></td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td><textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea></td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price" ></td>
                    </tr>

                    <tr>
                        <td>Upload Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>

                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">

                                <?php
                                    //PHP Code todisplay Categories from DB
                                    //SQL Queries to get all Active Categories from DB
                                    $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

                                    //Execute the Query
                                    $res = mysqli_query($conn, $sql);

                                    //Count the rows to Check whether we have categories or not
                                    $count = mysqli_num_rows($res);
                                    
                                    if($count > 0)
                                    {
                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                            //Get the Details of Categories
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>

                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="0">No Category Found</option>
                                        <?php
                                    }
                                ?>

                            </select>
                        </td>
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

            <?php
                //Check whether the submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //Get Data from the form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                    //Check whether the button for featured and active are checked or not
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
                        //Upload the image if selected
                        //To upload the image we need image name, source path and destination path
                        $image_name = $_FILES['image']['name'];

                        //Upload the image only if image is selected
                        if($image_name != "")
                        {
                            //Auto Rename the image
                            //Get the extensions of the image
                            $ext = end(explode('.', $image_name));

                            //Rename the image
                            $image_name = "food_name".rand(0000, 9999).'.'.$ext;

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = '../images/food/'.$image_name;

                            //Upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //Check whether the image is uploaded or not
                            //If the image is not uploaded stop the process and redirect with error message
                            if($upload==FALSE)
                            {
                                //Create a Session Variable to Display Message
                                $_SESSION['upload'] = '<div class="error">Failed to upload image</div>';

                                //Redirect Page
                                header('location:'.SITEURL.'admin/add-food.php');

                                //Stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = "";   //Set Default value as NULL
                    }

                    //Insert into DB
                    //SQL Query to add food
                    $sql2 = "INSERT INTO tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                    ";

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether Data is inserted or not
                    if($res2 == true)
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['add'] = '<div class="success">Food Added Successfully.</div>';

                        //Redirect Page
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['add'] = '<div class="error">Failed to Add Food.</div>';

                        //Redirect Page
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }
            ?>

        </div>
    </div>

<?php include('snippets/footer.php') ?>