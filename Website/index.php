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

    <?php
        if (isset($_SESSION['order'])) {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Dresses</h2>

            <?php  
                // To Display categories from databse that are active and featured
                // Creating SQL Query 
                $sql = "SELECT * FROM tbl_category 
                        WHERE Active = 'Yes' AND Featured = 'Yes' 
                        LIMIT 3";
                // Executing query
                $res = mysqli_query($conn, $sql);

                // Counting rows to check whether categories are available
                $count = mysqli_num_rows($res);

                // Checking whether categories are available 
                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // Getting values such as id, title, image
                        $id = $row['id'];
                        $title = $row['Title'];
                        $image_name = $row['Image_name'];

                        ?>
                            <a href="<?php echo HOMEURL; ?>category-itemss.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">

                                    <?php
                                        // Checking whether image is available
                                        if($image_name == "")
                                        {
                                            echo "<div class = 'red'> Image Not Available </div>";
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo HOMEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                        
                    }
                }
                else
                {
                    echo "<div class = 'red'> Category Not Added </div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- items MEnu Section Starts Here -->
    <section class="items-menu">
        <div class="container">
            <h2 class="text-center">Dress Store</h2>

            <?php
                // To Display itemss from databse that are active and featured
                // Creating SQL Query
                $sql2 = "SELECT * FROM tbl_items 
                WHERE Active = 'Yes' OR Featured = 'Yes'
                LIMIT 6 ";

                // Executing query
                $res2 = mysqli_query($conn, $sql2);

                // Counting rows to check whether itemss are available
                $count2 = mysqli_num_rows($res2);

                // Checking whether items are available 
                if($count2 > 0)
                {
                    while($row2 = mysqli_fetch_assoc($res2))
                    {
                        // Getting values such as id, title, image
                        $id = $row2['id'];
                        $title = $row2['Title'];
                        $price = $row2['Price'];
                        $description = $row2['Description'];
                        $image_name = $row2['Image_name'];

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
                    echo "<div class = 'red'> Items Not Available </div>";
                }
            ?>

           


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Items</a>
        </p>
    </section>
    <!-- items Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>