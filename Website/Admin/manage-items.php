<?php include('partials/menu.php'); ?>

<!--main content starts here  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage items</h1>

        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if (isset($_SESSION['remove-failed'])) {
            echo $_SESSION['remove-failed'];
            unset($_SESSION['remove-failed']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <br><br>

        <!-- Button to Add items -->
        <a href="<?php echo HOMEURL ?>admin/add-items.php" class="btn-primary">Add items</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            // Query to get all itemss data
            $sql = "SELECT * FROM tbl_items";

            // Executing the query
            $res = mysqli_query($conn, $sql);

            // Count rows to check whether we have itemss data 
            $count = mysqli_num_rows($res);

            // Creating serial number
            $sn = 1;

            if ($count > 0) {
                // Getting itemss data from database
                while ($row = mysqli_fetch_assoc($res)) {
                    // Getting values form individual columns 
                    $id = $row['id'];
                    $title = $row['Title'];
                    $price = $row['Price'];
                    $image_name = $row['Image_name'];
                    $featured = $row['Featured'];
                    $active = $row['Active'];

                    ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?>rs</td>
                        <td>
                            <?php
                                // Checking whether we have image
                                if($image_name == "") 
                                {
                                    echo "<div class = 'red'>Image not Added</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo HOMEURL ?>images/items/<?php echo $image_name ?>" width="100px" >
                                    <?php
                                }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo HOMEURL; ?>admin/update-items.php?id=<?php echo $id; ?>" class="btn-secondary">Update items</a>
                            <a href="<?php echo HOMEURL; ?>admin/delete-items.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete items</a>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                echo "<tr> <td colspan = '7' class = 'red'> items not Added Yet </td> </tr>";
            }
            ?>



        </table>
    </div>
</div>
<!--main content starts here  -->

<?php include('partials/footer.php'); ?>