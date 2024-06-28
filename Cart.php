<?php
session_start();
// Define cart as an empty array if it's not set
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$total_price = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - Sumazon</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="Style.css">
    <style>

        h2 {
            color: midnightblue;
            text-align: center;
            margin-top: 30px;
        }
        table {
            margin-top: 100px;
            width: 90%;
            border-collapse: collapse;
            
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .remove-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 6px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        .product-image {
            max-width: 100px;
        }
        button{
            background: midnightblue;
            margin-left: 45%;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            }
            .emptycart-msg {
            text-align: center;
            color: red;
            font-size: 18px;
            margin-top: 30px;
            font-weight: bold;
            }

            button:hover {
            background-color: cornflowerblue;
            }
        
    </style>
</head>
<body>
    <section id="header">
        <a href="#"><img src="Images/Logo1.png" class="logo" alt="Sumazon"></a>
        <div>
            <ul id="navbar">
                <li><a href="Main.php">Home</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li>
                    <a class="active" href="Cart.php">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <?php 
                            // Display cart count if cart is not empty
                            if(!empty($cart) && isset($_SESSION['cart_count']) && $_SESSION['cart_count'] > 0) {
                                echo '<span class="cart-count">' . $_SESSION['cart_count'] . '</span>';
                            }
                        ?>
                    </a>
                </li>
                <li><a href="Profile.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </section>

    <section id="cart">
        <h2>My Cart</h2>
        <?php if(empty($cart)): ?>
            <p class="emptycart-msg">Your cart is empty!!!!</p>
        <?php else: ?>
            <div class="products-container">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($cart as $key => $product) {
                                echo '<tr>';
                                echo '<td>' . $product['name'] . '</td>';
                                echo '<td>$' . $product['price'] . '</td>';
                                echo '<td><form action="removeFromCart.php" method="post">';
                                echo '<input type="hidden" name="key" value="' . $key . '">';
                                echo '<button type="submit" class="remove-btn" name="remove_from_cart">Remove</button>';
                                echo '</form></td>';
                                echo '</tr>';
                                // Increment total price
                                $total_price += $product['price'];
                            }

                                // Store total price in session
                                $_SESSION['total_price'] = $total_price;
                        ?>
                        <tr>
                            <td><strong>Total:</strong></td>
                            <td>$<?php echo $total_price; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button onclick="window.location.href='checkout.php'">Proceed to Checkout</button>
        <?php endif; ?>
    </section>
</body>
</html>
