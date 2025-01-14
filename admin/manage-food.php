<?php include('snippets/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br><br>

                <!-- Button to add Food -->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                <br><br><br>
                
                <?php

                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);    //Removing Session Message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);    //Removing Session Message
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);    //Removing Session Message
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);    //Removing Session Message
                    }

                    if(isset($_SESSION['remove-failed']))
                    {
                        echo $_SESSION['remove-failed'];
                        unset($_SESSION['remove-failed']);    //Removing Session Message
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);    //Removing Session Message
                    }

                ?>

                <table class="tbl-full">
                    <tr>
                        <th>Sl No.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        ////SQL Query to get all the food
                        $sql = "SELECT * FROM tbl_food";

                        //Exxecute the Query
                        $res = mysqli_query($conn, $sql);

                        //Count rows to check we have data or not
                        $count = mysqli_num_rows($res);

                        //Create Sl no. variable and initialise to 1
                        $sn = 1;

                        if($count > 0)
                        {
                            //Get the foods from he DB and display
                            while($row = mysqli_fetch_assoc($res))
                            {
                                //Get the data
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <?php
                                            //Check whether we have image or not
                                            if($image_name == "")
                                            {
                                                echo "<div class='error'>Image Not Added.</div>";
                                            }
                                            else
                                            {
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="70px" alt="<?php echo $image_name; ?>">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Edit</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-warning">Delete</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            echo "<tr><td colspan='7' class = 'error'>Food not Added yet</td></tr>";
                        }
                    ?>
                    
                </table>
        </div>
    </div>

<?php include('snippets/footer.php'); ?>