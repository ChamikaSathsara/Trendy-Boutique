<?php include('partials-front/menu.php'); ?>

    <!-- items sEARCH Section Starts Here -->
    <section class="items-search text-center">
        <div class="container">
            <?php
                // Getting the search keyword
                $search = $_POST['search'];
            ?>
            <h2>itemss on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- items sEARCH Section Ends Here -->



    <!-- items MEnu Section Starts Here -->
    <section class="items-menu">
        <div class="container">
            <h2 class="text-center">items Menu</h2>

            <?php
                // Getting search keyword
                $search = $_POST['search'];

                // SQL query to get itemss based on the keyword
                $sql = "SELECT * FROM tbl_items 
                        WHERE Title LIKE '%$search%' OR Description LIKE '%$search%' ";
                
                // Executing Query
                $res = mysqli_query($conn, $sql);

                // Counting rows 
                $count = mysqli_num_rows($res);

                // Checking whether itemss are available
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
                                    <p class="items-price"><?php echo $price; ?>rs</p>
                                    <p class="items-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="#" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    echo "<div class = 'red'> Items Not Found </div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- items Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>