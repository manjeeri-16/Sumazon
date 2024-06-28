<?php
$products = array(
    array(
        "name" => "Pink Party wear dress",
        "image" => "Images/Product.webp",
        "description" => "Fabric- Polyester/Spandex, Fabric is Elastic, Stretchy, Comfortable. A-Line, Bodycon, Wrap Waist, High Waist, Split Mermaid Hem, Ruffle, Solid Color, Long Length.",
        "price" => 50,
        "quantity" => 5
    ),
    array(
        "name" => "Silver Party wear dress for women",
        "image" => "Images/Product1.webp",
        "description" => "Silver party wear dress for women with a stylish design.",
        "price" => 73,
        "quantity" => 8
    ),
    array(
        "name" => "Baby Pink Gown",
        "image" => "Images/Product2.jpg",
        "description" => "Beautiful baby pink gown suitable for special occasions.",
        "price" => 70,
        "quantity" => 3
    ),
    array(
        "name" => "Women's Lavender Butterfly Frock",
        "image" => "Images/Product3.jpg",
        "description" => "Lavender butterfly frock for women with a unique design.",
        "price" => 71,
        "quantity" => 6
    ),
    array(
        "name" => "Michael Kors Purse",
        "image" => "Images/Product4.jpg",
        "description" => "Stylish Michael Kors purse for women.",
        "price" => 175,
        "quantity" => 10
    ),
    array(
        "name" => "Calvin Klein Twin Bags",
        "image" => "Images/Product5.jpg",
        "description" => "Twin bags set from Calvin Klein for a trendy look.",
        "price" => 79,
        "quantity" => 7
    ),
    array(
        "name" => "Nautica Sling Bag",
        "image" => "Images/Product6.jpg",
        "description" => "Nautica sling bag for a casual yet stylish appearance.",
        "price" => 18,
        "quantity" => 4
    ),
    array(
        "name" => "Women Sweatshirt",
        "image" => "Images/Product7.webp",
        "description" => "Comfortable sweatshirt for women available in various sizes.",
        "price" => 70,
        "quantity" => 9
    ),
    array(
        "name" => "Women Los Angeles Hoodie",
        "image" => "Images/Product8.webp",
        "description" => "Stylish Los Angeles hoodie for women.",
        "price" => 30,
        "quantity" => 12
    ),
    array(
        "name" => "Women Pink Sweatshirt",
        "image" => "Images/Product9.webp",
        "description" => "Pink sweatshirt for women with a trendy design.",
        "price" => 19.99,
        "quantity" => 15
    )
);

if(isset($_GET['search'])) {
    $search = $_GET['search'];

    $matching_products = array();

    // Loop through all products and search for products matching the search query
    foreach ($products as $product) {
        if (stripos($product['name'], $search) !== false) {
            $matching_products[] = $product;
        }
    }

    // Check if any results were found
    if (!empty($matching_products)) {
        // Output data of each matching product
        foreach ($matching_products as $product) {
            echo "<div>";
            echo "<img src='" . $product['image'] . "' alt='Product Image'>";
            echo "<p>Product Name: " . $product['name'] . "</p>";
            echo "<p>Description: " . $product['description'] . "</p>";
            echo "<p>Price: $" . $product['price'] . "</p>";

            // Check if the product is out of stock
            if ($product['quantity'] <= 0) {
                echo "<p>Out of Stock</p>";
            } else {
                // Display the add to cart form
                echo "<form action='addtocart.php' method='post'>";
                echo "<input type='hidden' name='product_name' value='" . $product['name'] . "'>";
                echo "<input type='hidden' name='product_price' value='" . $product['price'] . "'>";
                echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
                echo "</form>";
            }

            echo "</div>";
        }
    } else {
        echo "No products found matching your search.";
    }
}
?>