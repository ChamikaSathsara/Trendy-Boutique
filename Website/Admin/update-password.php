<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <br>

        <?php
        if (isset($_SESSION['pwd-not-equal'])) {
            echo $_SESSION['pwd-not-equal']; // Displaying Session
            unset($_SESSION['pwd-not-equal']); // Removing Session
        }
        ?>

        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <br>
                        <input type="submit" name="submit" value="Chage Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php

// Checking if the submit button is clicked
if (isset($_POST['submit'])) {
    // Getting all values 
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // Query 
    $sql = "SELECT * FROM tbl_admin
            WHERE id = '$id' AND password = '$current_password' ";

    // Executing Query
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        // Checking whether the data is available
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // Checking if the new_password and confirm_password is same
            if ($new_password == $confirm_password) {
                // Updating Password
                $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id = '$id' ";

                // Executing Query
                $res2 = mysqli_query($conn, $sql2);

                // Checking whether the query is excuted
                if ($res2 == true) {
                    // Creating a Session variable to display message
                    $_SESSION['change-pwd'] = "<div class='green'>Password Changed Successfully</div>";
                    // Redirect to update password page
                    header('location:' . HOMEURL . 'admin/manage-admin.php');
                } else {
                    // Creating a Session variable to display message
                    $_SESSION['change-pwd'] = "<div class='red'>Failed to Change Password</div>";
                    // Redirect to update password page
                    header('location:' . HOMEURL . 'admin/manage-admin.php');
                }
            } else {
                // Creating a Session variable to display message
                $_SESSION['pwd-not-equal'] = "<div class='red'>Password did not match</div>";
                // Redirect to update password page
                header('location:' . HOMEURL . 'admin/update-password.php');
            }
        } else {
            // Creating a Session variable to display message
            $_SESSION['user-not-found'] = "<div class='red'>User not found</div>";
            // Redirect to Manage admin page
            header('location:' . HOMEURL . 'admin/manage-admin.php');
        }
    }
}
?>

<?php include('partials/footer.php'); ?>