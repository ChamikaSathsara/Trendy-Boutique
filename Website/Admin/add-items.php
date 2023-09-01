<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Items</h1>

        <br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of Items">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="22" rows="3" placeholder="Description of Items"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <!-- ********** To Display Category From Database ************** -->
                            <?php
                            // SQL Query to get all active Categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' ";

                            // Executing Query
                            $res = mysqli_query($conn, $sql);

                            // Count rows to check whether we have categories
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                // We have category
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['Title'];

                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                // We don't have category
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            ?>
                            <!-- ************************************************************ -->
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featurd" value="Yes">Yes
                        <input type="radio" name="featurd" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Items" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Checking whether the submit btn clicked
        if (isset($_POST['submit'])) {
            // ****************** Adding Itemss in database *******************************

            // Getting data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            // Checking whether radio btn for featured and active is checked
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; // Setting default value
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; // Setting default value as no
            }

            // To Upload image 
            // Checking whether select image btn is clicked  
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                // Checking whether image is selected 
                if ($image_name != "") {
                    // Auto renaming the img (cause img with same name will get replaced by current img )
                    // Getting the extention of our img(jpg, png, etc)
                    $ext = end(explode('.', $image_name));

                    // Renaming img
                    $image_name = 'Items-Name-' . rand(0000, 9999) . '.' . $ext;

                    // To Upload Image getting source path and destination path
                    // Source path (Current location of img)
                    $src = $_FILES['image']['tmp_name'];

                    // Destination path for the image to be uploaded
                    $dest = "../images/Items/" . $image_name;

                    // Uploading image
                    $upload = move_uploaded_file($src, $dest);

                    // Checking whether the image is uploaded 
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class = 'red'>Failed to Upload Image </div>";
                        header('location:' . HOMEURL . 'admin/add-Items.php');

                        // Stoping the process
                        die();
                    }
                }
            } else {
                $image_name = ""; // Setting default value as blank
            }
            // **********************************************************************

            // ********************* Insert Into Database ***************************

            // Creating an sql query
            $sql2 = "INSERT INTO tbl_Items SET
                    Title = '$title',
                    Description = '$description',
                    Price = $price,
                    Image_name = '$image_name',
                    Category_id = $category,
                    Featured = '$featured',
                    Active = '$active' ";

            // Executing Query
            $res2 = mysqli_query($conn, $sql2);

            // Checking if Query is executed successfully
            if ($res2 == true) {
                $_SESSION['add'] = "<div class = 'green'> Items added Successfully </div>";
                header('location:' . HOMEURL . 'admin/manage-Items.php');
            } else {
                $_SESSION['add'] = "<div class = 'red'> Failed to add Items </div>";
                header('location:' . HOMEURL . 'admin/manage-Items.php');
            }

            // ********************************************************************** 
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>