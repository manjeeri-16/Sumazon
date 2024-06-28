<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sumazon</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="Style.css">

</head>
<body>
    <section id="header">
        <a href="#"><img src="Images/Logo1.png" class="logo" alt=" "></a>
        <div>
            <ul id="navbar">
                <li>
                    <form action="search.php" method="GET">
                        <input type="text" name="search" placeholder="Search products...">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </li>
                <li><a class="active" href="Main.php">Home</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="Cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <?php 
                            session_start();
                            if(isset($_SESSION['cart_count']) && $_SESSION['cart_count'] > 0) {
                                echo '<span class="cart-count">' . $_SESSION['cart_count'] . '</span>';
                            }
                        ?>
                    </a></li>
                <li><a href="Profile.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </section>

    <section id="hero">
        <h4>Discover, Click, Shop - Repeat!</h4>
        <h1>Fashion..Function..Fun..</h1>
    </section>

    <section id="product1">
        <h2>Featured Products</h2>
        <div class="pro-container">
            <?php
                include 'Connection.php';

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="pro" data-product-id="' . $row['id'] . '">';
                        echo '<img src="' . $row['product img'] . '" alt="">';
                        echo '<p>' . $row['product name'] . '</p>';
                        echo '<span>$' . $row['product price'] . '</span>';
                        echo '<form action="addtocart.php" method="post">';
                        echo '<input type="hidden" name="product name" value="' . $row['product name'] . '">';
                        echo '<input type="hidden" name="product price" value="' . $row['product price'] . '">';
                        echo '<button type="submit" name="add_to_cart">Add to Cart</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No products found</p>";
                }
                $conn->close();
            ?>
        </div>
    </section>
    <footer>
        <p>&copy; 2024 Sumazon. All rights reserved.</p>
    </footer>
    <script>
        const products = document.querySelectorAll('.pro');
        products.forEach(product => {
            product.addEventListener('click', () => {
                const productId = product.dataset.productId;

                const url = `Product.php?id=${productId}`;
                window.location.href = url;
            });
        });
    </script>
</body>
</html>