<?php include('partials/menu.php'); ?>

<!--main content starts here  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

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

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>


        <br><br>

        <!-- Button to Add Admin -->
        <a href="<?php echo HOMEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
            // Query to get all Categories
            $sql = "SELECT * FROM tbl_category";

            // Executing Query
            $res = mysqli_query($conn, $sql);

            // Counting rows to check data in database
            $count = mysqli_num_rows($res);

            // Creating Serial number
            $sn = 1;

            // Checking if data is present in database
            if ($count > 0) {
                // We have data
                // Getting data and Dispalying it
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['Title'];
                    $image_name = $row['Image_name'];
                    $featured = $row['Featured'];
                    $active = $row['Active'];

            ?>
                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php
                            // Checking whether img name is availabe 
                            if ($image_name != "") {
                                // Displaying img
                            ?>
                                <img src="<?php echo HOMEURL; ?>images/category/<?php echo $image_name; ?>" width="80px">
                            <?php
                            } else {
                                // Display message
                                echo "<div class = 'red'> Image not Added </div>";
                            }
                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo HOMEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo HOMEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>
                <?php

                }
            } else {
                // We don't have data 
                ?>
                <!-- This is done so we can write html -->
                <tr>
                    <td colspan="6">
                        <div class="red">
                            No Category Added
                        </div>
                    </td>
                </tr>

            <?php
            }

            // Checking if the query is executed successfully
            if ($res == true) {
            }
            ?>

        </table>
    </div>
</div>
<!--main content ends here  -->

<?php include('partials/footer.php'); ?>