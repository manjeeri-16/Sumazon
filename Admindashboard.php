<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                <li><a class="active" href="AdminDashboard.php">Admin Dashboard</a></li>
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
        <h4>Welcome to the Admin Dashboard !!!</h4>
        <h1>Admin-Specific Features</h1>
    </section>

    <section id="product1">
        <h2>Admin Tools</h2>
        <div class="pro-container">
            <div class="pro">
                <h3>Admin Tool 1</h3>
                <p>Manage the Products in the System.</p>
                <a href="Adminpage.php">Go to Admin Page</a>
            </div>
        </div>
    </section>

</body>

</html>