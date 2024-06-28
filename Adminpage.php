<?php
// Database connection parameters
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add a new product
function addProduct($name, $price, $description, $quantity, $image) {
    global $conn;
    $sql = "INSERT INTO products (`product name`, `product price`, `product description`, `product quantity`, `product img`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssis", $name, $price, $description, $quantity, $image);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to update an existing product
function updateProduct($id, $name, $price, $description, $quantity, $image) {
    global $conn;
    $sql = "UPDATE products SET `product name`=?, `product price`=?, `product description`=?, `product quantity`=?, `product img`=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $price, $description, $quantity, $image, $id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to delete a product
function deleteProduct($id) {
    global $conn;
    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_product'])) {
        // Add product
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $image = $_POST['image'];
        if (addProduct($name, $price, $description, $quantity, $image)) {
            echo "Product added successfully";
        } else {
            echo "Error adding product";
        }
    } elseif (isset($_POST['update_product'])) {
        // Update product
        $id = $_POST['update_id'];
        $name = $_POST['update_name'];
        $price = $_POST['update_price'];
        $description = $_POST['update_description'];
        $quantity = $_POST['update_quantity'];
        $image = $_POST['update_image'];
        if (updateProduct($id, $name, $price, $description, $quantity, $image)) {
            echo "Product updated successfully";
        } else {
            echo "Error updating product";
        }
    }
}

// Delete product
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (deleteProduct($id)) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>
    <h1>Admin Page</h1>

    <!-- Form to add new product -->
    <h2>Add New Product</h2>
    <form id="admin-product-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>
        <label for="quantity">Quantity:</label><br>
        <input type="text" id="quantity" name="quantity"><br>
        <label for="image">Image:</label><br>
        <input type="text" id="image" name="image"><br>
        <input type="submit" name="add_product" value="Add Product">
    </form>

    <!-- List of existing products -->
    <h2>Existing Products</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php
        // Fetch and display existing products
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["product name"] . "</td>";
                echo "<td>" . $row["product price"] . "</td>";
                echo "<td>" . $row["product description"] . "</td>";
                echo "<td>" . $row["product quantity"] . "</td>";
                echo "<td><img src='" . $row["product img"] . "' alt='Product Image' style='width:100px;height:100px;'></td>";
                echo "<td>
                        <form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>
                            <input type='hidden' name='update_id' value='" . $row["id"] . "'>
                            <input type='text' name='update_name' value='" . $row["product name"] . "'><br>
                            <input type='text' name='update_price' value='" . $row["product price"] . "'><br>
                            <textarea name='update_description'>" . $row["product description"] . "</textarea><br>
                            <input type='text' name='update_quantity' value='" . $row["product quantity"] . "'><br>
                            <input type='text' name='update_image' value='" . $row["product img"] . "'><br>
                            <input type='submit' name='update_product' value='Update Product'>
                        </form>
                        <form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='get'>
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                            <input type='submit' value='Delete'>
                        </form>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No products found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
