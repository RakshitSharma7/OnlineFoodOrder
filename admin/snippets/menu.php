<?php
    include('../config/constants.php');
    include('login-check.php');
?>

<html>
    <head>
        <title>wowFood</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>admin">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>admin/manage-admin.php">Admin</a></li>
                    <li><a href="<?php echo SITEURL; ?>admin/manage-category.php">Category</a></li>
                    <li><a href="<?php echo SITEURL; ?>admin/manage-food.php">Food</a></li>
                    <li><a href="<?php echo SITEURL; ?>admin/manage-order.php">Order</a></li>
                    <li><a href="<?php echo SITEURL; ?>admin/manage-query.php">Query</a></li>
                    <li><a href="<?php echo SITEURL; ?>admin/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->