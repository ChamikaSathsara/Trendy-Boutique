<?php

    // Include constants file to use the $conn
    include('../config/constants.php');

    // To get the id of the admin to be deleted
    $id = $_GET['id'];

    // Query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";

    // Executing Query 
    $res = mysqli_query($conn, $sql);

    // Checking whether the Query executed successfully
    if($res == true)
    {
        // Creating a Session variable to display message
        $_SESSION['delete'] = "<div class='green'>Admin deleted successfully</div>";

        // Redirect to Manage admin page
        header('location:'.HOMEURL.'admin/manage-admin.php');
    }
    else
    {
        // Creating a Session variable to display message
        $_SESSION['delete'] = "<div class='red'>Failed to Delete Admin, try again later</div>";

        // Redirect to Manage admin page
        header('location:'.HOMEURL.'admin/manage-admin.php');
    }

?>