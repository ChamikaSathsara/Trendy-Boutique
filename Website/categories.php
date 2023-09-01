<?php include('partials-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Dresses</h2>

            <?php
                // To Display categories from databse that are active
                // Creating SQL Query
                $sql = "SELECT * FROM tbl_category WHERE Active = 'Yes' ";

                // Executing Query
                $res = mysqli_query($conn, $sql);

                // Counting rows 
                $count = mysqli_num_rows($res);

                // Checking whether categories are available 
                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // Getting values
                        $id = $row['id'];
                        $title = $row['Title'];
                        $image_name = $row['Image_name'];

                        ?>
                            <a href="<?php echo HOMEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">

                                    <?php
                                        // Checking whether image is available
                                        if($image_name == "")
                                        {
                                            echo "<div class = 'red'> Image Not Found </div>";
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
                    echo "<div class = 'red'> Category Not Found </div>";
                }
            ?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>