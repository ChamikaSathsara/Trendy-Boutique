<?php 
    // Including Constants file
    include('../config/constants.php');

    // Checking whether id and image_name value is set
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Getting values
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Removing img if available
        if($image_name != "")
        {
            // Path of img
            $path = "../images/category/".$image_name;
            // Removing img
            $remove = unlink($path);

            // if img is not successfully deleted 
            if($remove == false)
            {
                // To display message
                $_SESSION['remove'] = "<div class='red'>Failed to Remove Category Image</div>";
                // Redirecting to manage category
                header('location:'.HOMEURL.'admin/manage-category.php');
                // Stoping the process
                die();
            }
        }

        // To Delete data from Database

        // Query
        $sql = "DELETE FROM tbl_category WHERE id = $id";
        // Executing Query
        $res = mysqli_query($conn, $sql);

        // Checking whether data is deleted from database
        if($res == true)
        {
            // To Display message
            $_SESSION['delete'] = "<div class='green'>Category Deleted Successfully</div>";
            // Redirecting to manage category
            header('location:'.HOMEURL.'admin/manage-category.php');
        }
        else
        {
            // To Display message
            $_SESSION['delete'] = "<div class='red'>Failed to Delete Category</div>";
            // Redirecting to manage category
            header('location:'.HOMEURL.'admin/manage-category.php');
        }
    }
    else
    {
        // Redirecting to manage-category
        header('location:'.HOMEURL.'admin/manage-category.php');
    }
?>