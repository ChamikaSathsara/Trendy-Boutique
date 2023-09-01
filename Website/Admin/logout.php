<?php
    include('../config/constants.php');
    // Destroy Session
    session_destroy(); // Unsets $_Session['user']

    // Redirect to Login Page
    header('location:'.HOMEURL.'admin/login.php');
?>