<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        .proinfocontainer {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .proinfocontainer img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-bottom: 20px;
        }
        .proinfocontainer h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: midnightblue;
        }
        .proinfocontainer p {
            font-size: 16px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

</head>
<body>
    <div class="proinfocontainer">
        <?php
        if(isset($_GET['id'])) {
            $productId = $_GET['id'];
            
            // Fetch product details based on the product ID
            $productDetails = getProductDetails($productId);

            if($productDetails) {
                echo '<img src="' . $productDetails['image'] . '" alt="' . $productDetails['name'] . '">';
                echo '<h1>' . $productDetails['name'] . '</h1>';
                echo '<p>' . $productDetails['description'] . '</p>';
                echo '<p>$' . $productDetails['price'] . '</p>';
            
            } else {
                echo 'Product not found.';
            }
        } else {
            echo 'Product ID not specified.';
        }

        function getProductDetails($productId) {
            $products = array(
                1 => array('name' => 'Pink Party wear dress', 'price' => 50, 'description' => 'Fabric- Polyester/Spandex ,Fabric is Elastic ,Stretchy, Comfortable. A-Line, Bodycon, Wrap Waist, High Waist, Split Mermaid Hem, Ruffle, Solid Color, Long Length.', 'image' => 'Images/Product.webp'),
                2 => array('name' => 'Silver Party wear dress for women', 'price' => 73, 'description' => 'Features: double V-Neck, sleeveless, embroidered lace, bodycon sheath design, floor length maxi dress. Delicate embroidery pattern with mermaid design make this eveing dress flattering and feminine', 'image' => 'Images/Product1.webp'),
                3 => array('name' => 'Baby Pink Gown', 'price' => 70, 'description' => 'WilFiks Brand Flower Girls Lace Appliques Prom Dresses for Teens 2024 Sweetheart Tulle Ball Gown Dresses for Women Formal Princess Dress with Slit Girls', 'image' => 'Images/Product2.jpg'),
                4 => array('name' => 'Womens Lavender Butterfly Frock', 'price' => 71, 'description' => 'Butterfly Tulle Prom Dresses Long Ball Gown Lace Applique Formal Dress Evening Gown for Women', 'image' => 'Images/Product3.jpg'),
                5 => array('name' => 'Michael Kors Purse', 'price' => 175, 'description' => 'Authentic Michael Kors, dust bag NOT included 88.92% coated canvas/11.08% polyester, Gold-tone hardware, polyester lining 3 compartments, center zip compartment', 'image' => 'Images/Product4.jpg'),
                6 => array('name' => 'Calvin Klein Twin Bags', 'price' => 79, 'description' => 'High quality vegan leather.1 Interior Slip Pcoket, 1 Interior Zip Pocket, 1 Removable Zip Pouch. Adjustable/removable crossbody strap', 'image' => 'Images/Product5.jpg'),
                7 => array('name' => 'Nautica Sling Bag', 'price' => 18, 'description' => 'Nautica cross body purse for women - Each cross body bag includes, 1 exterior zippered pocket, 1 interior zippered pocket, 2 slip pockets perfect for your smart phone and adjustable shoulder strap', 'image' => 'Images/Product6.jpg'),
                8 => array('name' => 'Women Sweatshirt', 'price' => 70, 'description' => 'WilFiks Brand Flower Girls Lace Appliques Prom Dresses for Teens 2024 Sweetheart Tulle Ball Gown Dresses for Women Formal Princess Dress with Slit Girls', 'image' => 'Images/Product7.webp'),
                9 => array('name' => 'Women Los Angeles Hoodie', 'price' => 30, 'description' => 'Grey hoodie Los Angeles, California for women.', 'image' => 'Images/Product8.webp'),
                10 => array('name' => 'Women Pink Sweatshirt', 'price' => 20, 'description' => 'Winter wear women sweatshirt.', 'image' => 'Images/Product9.webp')
            );

            if(array_key_exists($productId, $products)) {
                return $products[$productId];
            } else {
                return false;
            }
        }
        ?>
    </div>
</body>
</html>
