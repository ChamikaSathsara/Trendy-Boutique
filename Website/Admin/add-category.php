<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br><br>
        <!-- Add Category Form starts -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Category Form Ends -->

        <?php
        //  Checking whether the submit button is clicked
        if (isset($_POST['submit'])) {
            // Getting the values from form 
            $title = $_POST['title'];

            // For radio input type, Checking if the button is clicked 
            if (isset($_POST['featured'])) {
                // Getting value from form
                $featured = $_POST['featured'];
            } else {
                // Setting defulat value 
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                // Getting value from form
                $active = $_POST['active'];
            } else {
                // Setting defulat value 
                $active = "No";
            }

            // Checking whether the image is selected and setting value accoridingly
            if (isset($_FILES['image']['name'])) {
                // To upload image we need img name, source path and destination path
                $image_name = $_FILES['image']['name'];

                // Upload image only if image is selected
                if ($image_name != "") {
                    // Auto renaming the img (cause img with same name will get replaced by current img )
                    // Getting the extention of our img(jpg, png, etc)
                    $ext = end(explode('.', $image_name));

                    // Renaming img
                    $image_name = 'Items_category_' . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;

                    // Uploading image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Checking whether the image is uploaded
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='red'>Failed to Upload Image</div>";
                        header('location' . HOMEURL . 'admin/add-category.php');

                        // Stop the process (if we fail to upload then it should not be insterted into database)
                        die();
                    }
                }
            } else {
                // Don't upload image and set the image_name
                $image_name = "";
            }

            // SQL Query 
            $sql = "INSERT INTO tbl_category SET
                        Title = '$title',
                        Image_name = '$image_name',
                        Featured = '$featured',
                        Active = '$active' ";

            // Executing Query 
            $res = mysqli_query($conn, $sql);

            // Checking if the Query is Executed 
            if ($res == true) {
                $_SESSION['add'] = "<div class='green'>Categroy Added Successfully</div>";
                header('location:' . HOMEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='red'>Failed to Add Category</div>";
                header('location:' . HOMEURL . 'admin/add-category.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>