<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br>

        <br><br>

        <?php
        // Checking whether id is set 
        if (isset($_GET['id'])) {
            // Getting data
            $id = $_GET['id'];
            // SQL Query to get all detials
            $sql = "SELECT * FROM tbl_category WHERE id = $id";
            // Executing Query
            $res = mysqli_query($conn, $sql);

            // Counting rows to check whether the id is valid 
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // Getting data
                $row = mysqli_fetch_assoc($res);
                $title = $row['Title'];
                $current_image = $row['Image_name'];
                $featured = $row['Featured'];
                $active = $row['Active'];
            } else {
                $_SESSION['no-category-found'] = "<div class = 'red'>Category not found </div>";
                header('location:' . HOMEURL . 'admin/manage-category.php');
            }
        } else {
            // Redirecting to manage category
            header('location:' . HOMEURL . 'admin/manage-category.php');
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            // Displaying img
                        ?>
                            <img src="<?php echo HOMEURL; ?>images/category/<?php echo $current_image; ?> " width='150px'>
                        <?php
                        } else {
                            // Displaying Message
                            echo "<div class = 'red'> Image Not Added </div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_iamge" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Checking if the submit button is Clicked 
        if (isset($_POST['submit'])) {
            // Getting all values from form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_iamge = $_POST['current_iamge'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Updating new image if selected
            // Checking whether the img is selected or not
            if (isset($_FILES['image']['name'])) {
                // Getting image details
                $image_name = $_FILES['image']['name'];

                // Checking whether img is available
                if ($image_name != "") {
                    // **************** To Upload the new img ********************

                    // Auto renaming the img (cause img with same name will get replaced by current img )
                    // Getting the extention of our img(jpg, png, etc)
                    $ext = end(explode('.', $image_name));

                    // Renaming img
                    $image_name = 'Food_category_' . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;

                    // Uploading image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Checking whether the image is uploaded
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='red'>Failed to Upload Image</div>";
                        header('location' . HOMEURL . 'admin/manage-category.php');

                        // Stop the process (if we fail to upload then it should not be insterted into database)
                        die();
                    }
                    // *************************************************************************

                    // ****************** Removing Current image **********************************

                    if ($current_iamge != "") {
                        $remove_path = "../images/category/" . $current_iamge;
                        $remove = unlink($remove_path);

                        // Checking whether the image is removed successfully
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class = 'red' > Failed to remove Image </div>";
                            header('location:' . HOMEURL . 'admin/manage-category.php');
                            die();
                        }
                    }

                    // *************************************************************************

                } else {
                    $image_name = $current_iamge;
                }
            } else {
                $image_name = $current_iamge;
            }

            // Updating database
            $sql2 = "UPDATE tbl_category SET
                        Title = '$title',
                        Image_name = '$image_name',
                        Featured = '$featured',
                        Active = '$active' 
                        WHERE id = $id ";

            // Executing Query 
            $res2 = mysqli_query($conn, $sql2);

            // Checking whether query executed successfully
            if ($res2 == true) {
                $_SESSION['update'] = "<div class = 'green'> Category Updated Successfully </div>";
                header('location:' . HOMEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['update'] = "<div class = 'red'> Failed to Update Category </div>";
                header('location:' . HOMEURL . 'admin/manage-category.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>