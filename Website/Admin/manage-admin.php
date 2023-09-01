<?php include('partials/menu.php'); ?>

<!--main content starts here  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // Displaying Session
            unset($_SESSION['add']); // Removing Session 
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; // Displaying Session
            unset($_SESSION['delete']); // Removing Session
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; // Displaying Session
            unset($_SESSION['update']); // Removing Session
        }

        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd']; // Displaying Session
            unset($_SESSION['change-pwd']); // Removing Session
        }

        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found']; // Displaying Session
            unset($_SESSION['user-not-found']); // Removing Session
        }
        ?>

        <br><br>

        <!-- Button to Add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            // Query to get all admin
            $sql = "SELECT * FROM tbl_admin";

            // Execute the Query
            $res = mysqli_query($conn, $sql);

            // To check whether the query is executed 
            if ($res == true) {
                // Count rows to check whether we have data in database
                $count = mysqli_num_rows($res); // Function to get total num rows from database

                // Creating a variable to fix the sr.no. when we delete the row
                $sn = 1;

                // Check the num of rows 
                if ($count > 0) {
                    // Using while loop to get all data form database 
                    while ($rows = mysqli_fetch_assoc($res)) // it will run as long as it has data in it
                    {
                        // To get individual data
                        $id = $rows['id'];
                        $full_name = $rows['Full_name'];
                        $User_name = $rows['User_name'];

                        // To display the values in our table 
            ?>

                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $User_name; ?></td>
                            <td>
                                <a href="<?php echo HOMEURL; ?>admin/update-password.php?id=<?php echo $id ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo HOMEURL; ?>admin/update-admin.php?id=<?php echo $id ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo HOMEURL; ?>admin/delete-admin.php?id=<?php echo $id ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
            <?php

                    }
                } else {
                }
            }
            ?>

        </table>
    </div>
</div>
<!--main content starts here  -->

<?php include('partials/footer.php'); ?>