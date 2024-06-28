<?php
session_start();

if (isset($_POST['remove_from_cart']) && isset($_POST['key'])) {
    $key = $_POST['key'];

    // Remove the item from the cart
    unset($_SESSION['cart'][$key]);

    // Update cart count
    $_SESSION['cart_count']--;
    
    header("Location: Cart.php");
    exit();
} else {
    // Redirect to the cart page if the request is invalid
    header("Location: Cart.php");
    exit();
}
?>
