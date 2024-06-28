<?php
session_start(); 

include 'Connection.php';
$thank_you_message = "";

// Check if the order is confirmed
if(isset($_POST['confirm_order'])) {
    
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $total_price = 0;

        // Loop through cart items and update product quantities in the database
        foreach ($_SESSION['cart'] as $key => $product) {
            // Ensure 'id' and 'quantity' keys are set in the cart item
            if(isset($product['id']) && isset($product['quantity'])) {
                $product_id = $product['id'];
                $quantity = $product['quantity'];
                
                // Retrieve the current price of the product from the database
                $sql_select = "SELECT price FROM products WHERE id = $product_id";
                $result = $conn->query($sql_select);
                
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $product_price = $row['price'];
                    $total_price += $product_price * $quantity;
                } else {
                    echo "Error: Product not found in the database.";
                }
            } else {
                // Handle case where 'id' or 'quantity' key is missing
                echo "Invalid product ID or quantity";
            }
        }
        
        // Clear the cart after order confirmation
        unset($_SESSION['cart']);
        $thank_you_message = "Thank you for shopping with Sumazon!";
        header("Location: thankyou.php");
        exit;
    } else {
        header("Location: Cart.php");
        exit; 
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sumazon - Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
            padding: 10px;
            align-items: center;
           
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .checkout-header {
            text-align: center;
            margin-bottom: 20px;
            color: midnightblue;
        }

        .cart-summary {
            margin-bottom: 20px;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-table th,
        .cart-table td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .cart-table th {
            text-align: center;
        }

        .cart-table tfoot td {
            font-weight: bold;
            text-align: center;
            
        }

        .checkout-button {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .checkout-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="checkout-header">Checkout</h2>
        <?php if(!empty($thank_you_message)): ?>
            <div class="thank-you-message">
                <?php echo $thank_you_message; ?>
            </div>
        <?php else: ?>
            <div class="cart-summary">
                <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_price = 0; 
                            foreach ($_SESSION['cart'] as $key => $product): 
                                $total_price += $product['price']; 
                            ?>
                                <tr>
                                    <td><?php echo $product['name']; ?></td>
                                    <td>$<?php echo $product['price']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="1"><strong>Total:</strong></td>
                                <td>$<?php echo number_format($total_price, 2); ?></td> <!-- Display total price -->
                            </tr>
                        </tfoot>
                    </table>
                <?php else: ?>
                    <?php header("Location: Cart.php"); ?>
                    <?php exit; ?>
                <?php endif; ?>
            </div>
            <form method="post">
                <button class="checkout-button" type="submit" name="confirm_order">Make Payment</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>