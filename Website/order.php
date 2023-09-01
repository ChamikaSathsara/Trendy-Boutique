<?php include('partials-front/menu.php'); ?>

    <?php
        // Checking whether items id is set
        if(isset($_GET['items_id']))
        {
            // Getting items id 
            $items_id = $_GET['items_id'];

            // Getting details of selected items
            $sql = "SELECT * FROM tbl_items WHERE id = $items_id";

            // Executing query
            $res = mysqli_query($conn, $sql);

            // Counting rows 
            $count = mysqli_num_rows($res);

            // Checking whether items are available 
            if($count == 1)
            {
                // Getting data from database
                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $title = $row['Title'];
                $price = $row['Price'];
                $image_name = $row['Image_name'];
            }
            else
            {
                header('location:'. HOMEURL);
            }
        }
        else
        {
            header('location:' . HOMEURL);
        }
    ?>

    <!-- items sEARCH Section Starts Here -->
    <section class="items-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected items</legend>

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
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="items" value="<?php echo $title; ?>">
                        
                        <p class="items-price"><?php echo $price; ?>rs</p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" min="0" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Your Full Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="number" name="contact" placeholder="Your Number" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Your E-mail" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Your Address" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                // Checking whether submit button is clicked
                if(isset($_POST['submit']))
                {
                    // Getting data from form
                    $items = $_POST['items'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    
                    $total = $price * $qty;
                    
                    $order_date = date("Y-m-d h:i:sa"); 
                    
                    $status = "Ordered";
                    
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    // Saving data in database 
                    // Query
                    $sql2 = "INSERT INTO tbl_order SET
                            items = '$items',
                            Price = $price,
                            Qty = $qty,
                            Total = $total,
                            Order_date = '$order_date',
                            Status = '$status',
                            Customer_name = '$customer_name',
                            Customer_contact = '$customer_contact',
                            Customer_email = '$customer_email',
                            Customer_address = '$customer_address' ";
                    
                    // Executing query
                    $res2 = mysqli_query($conn, $sql2);

                    // Checking whether query executed successfully 
                    if($res2 == true)
                    {
                        $_SESSION['order'] = "<div class = 'green text-center'> Order Placed Successfully </div>";
                        header('location:' . HOMEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class = 'red text-center'> Order Failed </div>";
                        header('location:' . HOMEURL);
                    }

                }
            ?>

        </div>
    </section>
    <!-- items sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>