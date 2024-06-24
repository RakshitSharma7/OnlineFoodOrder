<?php include('snippets/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1>
            <br><br>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);    //Removing Session Message
                }

                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);    //Removing Session Message
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);    //Removing Session Message
                }

                if(isset($_SESSION['no-category-found']))
                {
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);    //Removing Session Message
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);    //Removing Session Message
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);    //Removing Session Message
                }

                if(isset($_SESSION['failed-remove']))
                {
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);    //Removing Session Message
                }
            ?>

            <br><br>

            <!-- Button to add Category -->
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br><br><br>
            
            <table class="tbl-full">

                <tr>
                    <th>Sl No.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>

                <?php
                    //Query to get all Data from the DB
                    $sql = "SELECT * FROM tbl_category";

                    //Execute the Query
                    $res = mysqli_query($conn, $sql);

                    //Count the rows
                    $count = mysqli_num_rows($res);

                    //Create Serial number value and assign its value as one
                    $sn = 1;

                    //Check whether we data in DB
                    if($count>0)
                    {
                        //Get the data and display
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>

                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $title ?></td>

                                <td>

                                    <?php
                                        //Check whether image_name is available or not
                                        if($image_name!="")
                                        {
                                            //Display the image
                                            ?>

                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="60px" alt="<?php echo $image_name; ?>">
                                            
                                            <?php
                                        }
                                        else
                                        {
                                            //Display the messagw
                                            echo "<div class='error'>Image Not Added</div>";
                                        }
                                    ?>
                                    
                                </td>
                                
                                <td><?php echo $featured ?></td>
                                <td><?php echo $active ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Edit</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-warning">Delete</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else
                    {
                        //Display the message inside the table
                        ?>

                        <tr>
                            <td colspan="6"><div class="error">No Category Added.</div></td>
                        </tr>

                        <?php
                    }
                ?>
                    
            </table>
        </div>
    </div>

<?php include('snippets/footer.php'); ?>