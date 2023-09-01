<?php
    ob_start(); // To fix header already sent 
    // Start Session
    session_start();  // It is defined here cause it's attached to every page

    // Creating constant for home url
    define('HOMEURL', 'http://localhost/Website/');

    // Create constants to store non repeating values
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'order-items');
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, PASSWORD) or die(mysqli_error($conn)); // Database Connection 
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); // Database Selection
?>