<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Updtae Admin</h1>

        <br><br>

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; // Displaying Session
            unset($_SESSION['update']); // Removing Session 
        }
        ?>

        <br><br>

        <?php
        // To get the id of selected Admin
        $id = $_GET['id'];

        // Creating Query to get details
        $sql = "SELECT * FROM tbl_admin WHERE id = $id";

        // Executing Query
        $res = mysqli_query($conn, $sql);

        // Checking whether the query is executed Successfully
        if ($res == true) {
            // To Check, let's see if we have data in database
            $count = mysqli_num_rows($res); // Counting rows

            if ($count == 1) {
                // Getting details
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['Full_name'];
                $username = $row['Username'];
            } else {
                // Redirect to Manage Admin page
                header('location:' . HOMEURL . 'admin/manage-admin.php');
            }
        }
        ?>

        <form action="" method="post"></form>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <br>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
// Checking if the submit button is clicked
if (isset($_POST['submit'])) {
    // Getting all values from form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    // Query to update data
    $sql = "UPDATE tbl_admin SET 
                Full_name = '$full_name',
                Username = '$username'
                WHERE id = '$id' ";

    // Executing Query
    $res = mysqli_query($conn, $sql);

    // Checking if the Query is executed successfully
    if ($res == true) {
        // Creating a Session variable to display message
        $_SESSION['update'] = "<div class='green'>Admin updated Successfully</div>";

        // Redirect to Manage admin page
        header('location:' . HOMEURL . 'admin/manage-admin.php');
    } else {
        // Creating a Session variable to display message
        $_SESSION['update'] = "<div class='red'>Failed to update Admin</div>";

        // Redirect to Manage admin page
        header('location:' . HOMEURL . 'admin/update-admin.php');
    }
}
?>

<?php include("partials/footer.php"); ?>