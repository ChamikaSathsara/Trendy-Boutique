<?php
    // Authorization - Access Control
    // Check whether the user is logged in 

    if (!isset($_SESSION['user'])) //If user session is not set
    {
        // user is not logged in
        $_SESSION['no-login'] = "<div class = 'red'>Please login to access Admin Panel</div>";
        // Redirect to login page
        header('location:'.HOMEURL.'admin/login.php');
    }
?>