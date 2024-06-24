<?php include('snippets/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br><br>

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);    //Removing Session Message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?>

                <br><br><br>

                <!-- Button to add Admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br><br><br>
                
                <table class="tbl-full">
                    <tr>
                        <th>Sl No.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        //Query to Get all Admins
                        $sql = "SELECT * FROM tbl_admin";

                        //Execute the Query
                        $res = mysqli_query($conn, $sql);

                        //Check whether the Query is executed or not
                        if($res==TRUE)
                        {
                            //Count rows to check whether we have data in DB
                            $count = mysqli_num_rows($res);

                            $sn = 1;

                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //Get Individual Row Data
                                    $id = $rows['id'];
                                    $full_name  = $rows['full_name'];
                                    $username = $rows['username'];
                                    
                                    ?>

                                    <!-- Display the values in Table -->
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Edit</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-warning">Delete</a>
                                         </td>
                                    </tr>

                                    <?php
                                }
                            }
                        }
                    ?>
                    
                </table>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content Section Ends -->

<?php include('snippets/footer.php'); ?>