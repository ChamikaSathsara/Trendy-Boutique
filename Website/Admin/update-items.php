<?php include('partials/menu.php') ?>

<?php
// Checking whether the id is set
if (isset($_GET['id'])) {
    // Getting id
    $id = $_GET['id'];

    // Sql query to get the selected items
    $sql2 = "SELECT * FROM tbl_items WHERE id = $id ";
    // Executing query
    $res2 = mysqli_query($conn, $sql2);

    // Getting the values 
    $row2 = mysqli_fetch_assoc($res2);

    // Getting the individual values of selected items
    $title = $row2['Title'];
    $description = $row2['Description'];
    $price = $row2['Price'];
    $current_image = $row2['Image_name'];
    $current_category = $row2['Category_id'];
    $featured = $row2['Featured'];
    $active = $row2['Active'];
} else {
    header('location:' . HOMEURL . 'admin/manage-items.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update items</h1>

        <br>

        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="22" rows="3"> <?php echo $description; ?> </textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        // Checking whether image is available
                        if ($current_image == "") {
                            echo "<div class = 'red'> Image Not Available </div> ";
                        } else {
                        ?>
                            <img src="<?php echo HOMEURL; ?>images/items/<?php echo $current_image; ?>" width="100px" >
                        <?php
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
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                            // Query to get active categories
                            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' ";
                            // Executing Query
                            $res = mysqli_query($conn, $sql);

                            // Counting rows
                            $count = mysqli_num_rows($res);

                            // Checking whether category is available
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['Title'];
                                    $category_id = $row['id'];

                            ?>
                                <option <?php if ($current_category == $category_id) {echo "selected";} ?> value='<?php echo $category_id; ?>'> <?php echo $category_title; ?> </option>
                            <?php
                                }
                            } else {
                                echo "<option value = '0'> Category Not Available </option>";
                            }
                            ?>

                        </select>
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
                                } ?> type="radio" name="featured" value="No"> NO
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
                                } ?> type="radio" name="active" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update items" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Checking whether the submit button is clicked
        if (isset($_POST['submit'])) {
            // ***************** Getting all detail from form ***************************

            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // ***************************************************************************

            // **************** Uploading image if Selected ******************************

            // Checking whether the upload button is clicked 
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                // Upload image only if image is selected
                if ($image_name != "") {
                    // Auto renaming the img (cause img with same name will get replaced by current img )
                    // Getting the extention of our img(jpg, png, etc)
                    $ext = end(explode('.', $image_name));

                    // Renaming img
                    $image_name = 'items-Name-' . rand(0000, 9999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/items/" . $image_name;

                    // Uploading image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Checking whether the image is uploaded
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='red'>Failed to Upload Image</div>";
                        header('location' . HOMEURL . 'admin/add-category.php');

                        // Stop the process
                        die();
                    }

                    //  *************************************************************************************

                    //  ************* Removing img if new img is uploaded and current img exists ************

                    // Removing current image if available
                    if($current_image != "")
                    {
                        // Removing image
                        $remove_path = "../images/items/" . $current_image;

                        $remove = unlink($remove_path);

                        // Checking whether image is removed successfully
                        if($remove == false)
                        {
                            $_SESSION['remove-failed'] = "<div class = 'red'> Failed to Remove Current Image </div>";
                            header('location:' . HOMEURL . 'admin/manage-items.php');

                            // Stoping process
                            die();
                        }
                    }

                    // **************************************************************************************
                }
                else
                {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            // ************************* Updating items data in Database *************************************

            // Query
            $sql3 = "UPDATE tbl_items SET
                    Title = '$title',
                    Description = '$description',
                    Price = $price,
                    Image_name = '$image_name',
                    Category_id = '$category',
                    Featured = '$featured',
                    Active = '$active' 
                    WHERE id = $id";

            // Execute the sql query 
            $res3 = mysqli_query($conn, $sql3);

            // Checking whether the query is executed successfully
            if($res3 == true)
            {
                $_SESSION['update'] = "<div class = 'green'> items Updated Successfully </div>";
                header('location:' . HOMEURL . 'admin/manage-items.php');
            }
            else
            {
                $_SESSION['update'] = "<div class = 'red'> Failed to Upload items </div>";
                header('location:' . HOMEURL . 'admin/manage-items.php');
            }

            // **********************************************************************************************
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>