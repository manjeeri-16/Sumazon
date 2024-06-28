<?php
session_start();

if(isset($_POST['add_to_cart'])) {
    if(isset($_POST['product_name']) && isset($_POST['product_price'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];

        // Ensure that the product price is a valid number
        if(!is_numeric($product_price) || $product_price <= 0) {
            // Handle invalid price (e.g., display an error message or redirect back to the product page)
            header("Location: Product.php");
            exit();
        }

        // Create an array to store product details
        $product = array(
            'name' => $product_name,
            'price' => $product_price,
        );

        // Add the new product to the cart
        if(isset($_SESSION['cart'])) {
            $_SESSION['cart'][] = $product;
        } else {
            $_SESSION['cart'] = array($product);
        }

        // Update the cart count
        $_SESSION['cart_count'] = count($_SESSION['cart']);

        // Redirect back to the cart page
        header("Location: Cart.php");
        exit();
    } else {
        // Redirect to the cart page if all necessary data is not provided
        header("Location: Cart.php");
        exit();
    }
} else {
    // Redirect to the cart page if the form was not submitted properly
    header("Location: Cart.php");
    exit();
}
?>
