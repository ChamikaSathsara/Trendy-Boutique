<?php include('partials-front/menu.php'); ?>

    <!-- items sEARCH Section Starts Here -->
    <section class="items-search text-center">
        <div class="container">
            
            <form action="<?php echo HOMEURL; ?>items-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Items.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- items sEARCH Section Ends Here -->


    <!-- items MEnu Section Starts Here -->
    <section class="items-menu">
        <div class="container">
            <h2 class="text-center">Dress Store</h2>

            <?php
                // To Display itemss from databse that are active
                // Creating SQL Query
                $sql = "SELECT * FROM tbl_items 
                WHERE Active = 'Yes' "; 

                // Executing query
                $res = mysqli_query($conn, $sql);

                // Counting rows to check whether itemss are available
                $count = mysqli_num_rows($res);

                // Checking whether items are available 
                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // Getting values such as id, title, image
                        $id = $row['id'];
                        $title = $row['Title'];
                        $price = $row['Price'];
                        $description = $row['Description'];
                        $image_name = $row['Image_name'];

                        ?>
                            <div class="items-menu-box">
                                <div class="items-menu-img">
                                    <?php
                                        // Checking whether image is available
                                        if($image_name == "")
                                        {
                                            echo "<div class = 'red'> Image Not Available </div>";
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo HOMEURL; ?>images/items/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="items-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="items-price"><?php echo $price; ?> LKR</p>
                                    <p class="items-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo HOMEURL; ?>order.php?items_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    echo "<div class = 'red'> items Not Found </div>";
                }
            ?>

            <div class="clearfix"></div>
            
        </div>

    </section>
    <!-- items Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>