<?php include("partials/menu.php"); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // Displaying Session
            unset($_SESSION['add']); // Removing Session 
        }
        ?>

        <br><br>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php include("partials/footer.php"); ?>

<!-- Process the values from Form and save in the database -->

<!-- Check whether the submit button is cliked or not  -->
<?php

if (isset($_POST['submit'])) {

    // Getting data from Form
    $Full_name = $_POST['full_name'];
    $User_name = $_POST['username'];
    $Password = md5($_POST['password']); // Password Encryption with MD5

    // SQL Query to save the data into the database
    $sql = "INSERT INTO tbl_admin SET
                Full_name = '$Full_name',
                User_name = '$User_name',
                Password = '$Password' 
                ";

    // Execute Query and save in the database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == true) {
        // Creating a Session variable to display message
        $_SESSION['add'] = "<div class='green'>Admin Added Successfully</div>";
        // Redirect
        header('location:' . HOMEURL . 'admin/manage-admin.php');
    } else {
        // Creating a Session variable to display message
        $_SESSION['add'] = "<div class='red'>Failed to Add Admin</div>";
        // Redirect
        header('location:' . HOMEURL . 'admin/add-admin.php');
    }
}

?>