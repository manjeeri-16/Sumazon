<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["address"]) || empty($_POST["phone"]) || empty($_POST["password"])) {
        $error = "All fields are required";
    } else {
        // Retrieve logged-in user ID (replace with your actual mechanism to get user ID)
        $user_id = 1;

        $username = $_POST["username"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];

        $sql = "UPDATE users SET username=?, email=?, address=?, phone=?, password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $username, $email, $address, $phone, $password, $user_id);

    
        if ($stmt->execute()) {
            $message = "Profile updated successfully";
        } else {
            $error = "Error updating profile: " . $conn->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="Style.css">
</head>
<style>
            body {
                background-image: url('Images/admin-login-background-images-8.jpg');
                background-size: cover;
                background-repeat: no-repeat;
            }
        </style>
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
                <li><a href="Main.php">Home</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="Cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <?php 
                            session_start();
                            if(isset($_SESSION['cart_count']) && $_SESSION['cart_count'] > 0) {
                                echo '<span class="cart-count">' . $_SESSION['cart_count'] . '</span>';
                            }
                        ?>
                    </a></li>
                    <li><a class="active" href="Profile.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </section>

    <div class="profile-container">
        <h1>Edit Profile</h1>
        <div class="message">
        <?php if (!empty($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <?php if (!empty($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="profile-form">
            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Username</label>
                <input type="text" id="username" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                <textarea id="address" name="address" placeholder="Address"></textarea>
            </div>
            <div class="form-group">
                <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Phone Number">
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" name="save_changes">Save Changes</button>
        </form>
    </div>
    <footer>
        <p>&copy; 2024 Sumazon. All rights reserved.</p>
    </footer>
</body>
</html>