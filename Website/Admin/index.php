<?php include('partials/menu.php'); ?>
<?php include('partials/login-check.php'); ?>

<!-- Main content starts here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>

        <br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login']; // Displaying Session
            unset($_SESSION['login']); // Removing Session
        }
        ?>

        <br><br>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>

        <div class="clearfix"></div>

    </div>
</div>
<!-- Main content ends here -->

<?php include('partials/footer.php'); ?>