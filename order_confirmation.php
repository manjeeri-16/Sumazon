<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sumazon - Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2 class="checkout-heading">Checkout</h2>
        <div class="cart-summary">
            <!-- Cart summary will be dynamically generated here -->
        </div>
        <button class="confirm-order-btn" onclick="confirmOrder()">Confirm Order</button>
    </div>

    <script>
        function confirmOrder() {
            // JavaScript function to handle order confirmation
            alert("Order confirmed! Thank you for shopping with Sumazon.");
            // Redirect to home page or order confirmation page
            window.location.href = "index.php";
        }
    </script>
</body>
</html>
