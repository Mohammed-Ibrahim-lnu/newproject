<?php
session_start();
require 'db.php';

// Buy now — clear cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy_now'])) {
    $_SESSION['cart'] = [];
    $_SESSION['message'] = 'Thank you for your purchase!';
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Frugal Company - Shopping</title>
    <link rel="stylesheet" href="style.css?v=1.1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css?v=1.1' rel='stylesheet'>
</head>

<body>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<script>alert('" . $_SESSION['message'] . "');</script>";
        unset($_SESSION['message']);
    }
    ?>
    <header>
        <div class="nav container">
            <a href="/index.php" class="logo"> Frugal Company </a>
            <ul class="nav-links">
                <li><a href="/index.php" class="nav-link">HOME</a></li>
                <li><a href="/gpu.php" class="nav-link">GPU</a></li>
                <li><a href="/cpu.php" class="nav-link">CPU</a></li>
                <li><a href="#" class="nav-link">RAM</a></li>
                <li><a href="#" class="nav-link">CASE</a></li>
            </ul>

            <i class='bx bxs-shopping-bag' id="cart-icon"></i>
            <div class="cart">
                <h2 class="cart-title">Your Cart</h2>
                <div class="cart-content">
                    <!-- JS will populate this on page load -->
                </div>
                <div class="total">
                    <div class="total-title">Total</div>
                    <div class="total-price">$0</div>
                </div>
                <button type="button" class="btn-buy">Buy Now</button>
                <i class='bx bx-x' id="close-cart"></i>
            </div>
        </div>
    </header>

    <section class="shop-container">
        <h2 class="section-title">Products</h2>
        <div class="shop-content">
            <?php
            $sql = "SELECT * FROM products_gpu";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-box'>
                <img src='" . $row['image_url'] . "' alt='' class='product-img'>
                <h2 class='product-title'>" . htmlspecialchars($row['title']) . "</h2>
                <span class='price'>$" . number_format($row['price'], 2) . "</span>
                <button class='add-cart' 
                 data-id='" . $row['id'] . "' 
                 data-category='gpu'>
                    <i class='bx bx-shopping-bag'></i>
                </button>
            </div>";
                }
            } else {
                echo "<div>No products found</div>";
            }
            $conn->close();
            ?>

        </div>
    </section>

    <script src="main.js?v=1.1"></script>
</body>

</html>