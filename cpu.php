<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frugal Company Website - Shopping</title>
    <!-- LINK TO CSS-->
    <link rel="stylesheet" href="style.css">
    <!-- LINK TO PHP -->
    <?php
    include 'db.php'; // This will include your connection file
    ?>

    <!-- Links to box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <header>
        <!-- nav menu -->
        <div class="nav container"> 
            <a href="/index.php" class="logo"> Frugal Company </a>

            <!-- Navigation Menu -->
            <ul class="nav-links">
                <li><a href="/index.php" class="nav-link">HOME</a></li>
                <li><a href="/gpu.php" class="nav-link">GPU</a></li>
                <li><a href="/cpu.php" class="nav-link">CPU</a></li>
                <li><a href="#" class="nav-link">RAM</a></li>
                <li><a href="#" class="nav-link">CASE</a></li>
            </ul>

            <!-- cart icon from (boxicons)-->
            <i class='bx bxs-shopping-bag' id="cart-icon"></i>
            <div class="cart">
                <h2 class="cart-title">Your Cart</h2>
                <!-- Content -->
                <div class="cart-content">
                    <div class="cart-box">
                        <!--remove cart here-->
                        <i class='bx bxs-trash-alt cart-remove'></i>
                    </div>
                </div>
                <!-- Total -->
                <div class="total">
                    <div class="total-title">Total</div>
                    <div class="total-price">$0</div>
                </div>
                <!--buy button-->
                <button type="button" class="btn-buy">Buy Now</button>
                <!-- Cart Close -->
                <i class='bx bx-x' id="close-cart"></i>
            </div>
        </div>
    </header>

    <!-- SHOP -->
    <section class="shop-container">
    <h2 class="section-title">CPUs</h2>
    <!-- Shop content -->
    <div class="shop-content">
        <?php

        // Query to fetch products_cpu
        $sql = "SELECT * FROM products_cpu";
        $result = $conn->query($sql);

        // Loop through and display the products
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='product-box'>";
                echo "<img src='" . $row['image_url'] . "' alt='' class='product-img'>";
                echo "<h2 class='product-title'>" . $row['title'] . "</h2>";
                echo "<span class='price'>$" . $row['price'] . "</span>";
                echo "<i class='bx bx-shopping-bag add-cart'></i>";
                echo "</div>";
            }
        } else {
            echo "No products found";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</section>


    <!--Link to JS-->
    <script src="main.js"></script>
</body>
</html>
