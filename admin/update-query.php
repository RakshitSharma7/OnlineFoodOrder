<?php include('snippets/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Query</h1>
        <br><br>

        <?php
            //Check whether ID is set or not
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                //SQL Query to get Query details of the ID
                $sql = "SELECT * FROM tbl_query WHERE id=$id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the rows
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $name = $row['name'];
                    $email = $row['email'];
                    $status = $row['status'];
                    $message = $row['message'];
                }
                else
                {
                    //Regirect to Manage Queries Page
                    header('location:'.SITEURL.'admin/manage-query.php');
                }
            }
            else
            {
                //Regirect to Manage Queries Page
                header('location:'.SITEURL.'admin/manage-query.php');
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td><b><?php echo $name; ?></b></td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td><b><?php echo $email; ?></b></td>
                </tr>

                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option value="Unresolved" <?php if($status == "Unresolved") echo "selected"; ?>>Unresolved</option>
                            <option value="Resolved" <?php if($status == "Resolved") echo "selected"; ?>>Resolved</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Message: </td>
                    <td><?php echo $message; ?></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Save" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php
            //Check whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //Get all the values from the form
                $status = $_POST['status'];

                $sql2 = "UPDATE tbl_query SET
                    status = '$status'
                    WHERE id = $id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == TRUE)
                {
                    $_SESSION['update'] = "<div class='success'>Query Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-query.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to update Query.</div>";
                    header('location:'.SITEURL.'admin/manage-query.php');
                }
            }
        ?>

    </div>
</div>

<?php include('snippets/footer.php'); ?>