<?php include('snippets/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Queries</h1>
        <br><br>

        <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <br><br>

        <table class="tbl-full">
            <tr>
                <th>Sl No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Message</th>
                <th>Action</th>
            </tr>

            <?php
                //Get all the Queries from DB
                $sql = "SELECT * FROM tbl_query ORDER BY id DESC";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                $sn = 1;

                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //Get all the values
                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $status = $row['status'];
                        $message = $row['message'];

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $email; ?></td>

                            <td>
                                <?php
                                    if($status == "Resolved")
                                        echo "<label style='color: green;'>$status</label>";
                                    else
                                        echo "<label style='color: red;'>$status</label>";
                                ?>
                            </td>

                            <td><?php echo $message; ?></td>
                            <td><a href="<?php echo SITEURL; ?>admin/update-query.php?id=<?php echo $id; ?>" class="btn-secondary">Edit</a></td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='6' class='error text-center'>Queries Not Available.</td></tr>";
                }
            ?>

        </table>
    </div>
</div>

<?php include('snippets/footer.php'); ?>