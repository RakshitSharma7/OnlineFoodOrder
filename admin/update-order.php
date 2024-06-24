<?php

use function PHPSTORM_META\sql_injection_subst;

 include('snippets/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php

            //Check whether id is set or not
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                //SQL Query to get order details for the ID
                $sql = "SELECT * FROM tbl_order WHERE id=$id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the rows
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($res);

                    //Get all the details
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else
                {
                    //Redirect to Manage Order Page
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                //Redirect to Manage Order Page
                header('location:'.SITEURL.'admin/manage-order.php');
            }

        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Food: </td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><b>$ <?php echo $price; ?></b></td>
                </tr>

                <tr>
                    <td>Quantity: </td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                
                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option value="Ordered" <?php if($status == "Ordered")  echo "selected" ?>>Ordered</option>
                            <option value="On Delivery" <?php if($status == "On Delivery")  echo "selected" ?>>On Delivery</option>
                            <option value="Delivered" <?php if($status == "Delivered")  echo "selected" ?>>Delivered</option>
                            <option value="Cancelled" <?php if($status == "Cancelled")  echo "selected" ?>>Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td><textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Save" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php

            //Check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //Get all the values from form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                
                $total = $price * $qty;

                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                //Update the DB
                $sql2 = "UPDATE tbl_order SET
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id = $id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether Query Executed or not
                if($res2 == TRUE)
                {
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }

        ?>

    </div>
</div>

<?php include('snippets/footer.php'); ?>