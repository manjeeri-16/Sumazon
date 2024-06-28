<?php
session_start();

include("C:/xampp/htdocs/sumazon1/Connection.php");

$error_message = "";

if(isset($_POST['submit'])) {
    if(isset($_POST['email']) && isset($_POST['password'])) { // Check if email and password are set
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if(empty($email) || empty($password)) {
            $error_message = "Email and password are required.";
        } else {
            $result = mysqli_query($conn, "SELECT * FROM users WHERE Email='$email'");
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                if($row['password'] == $password) {
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['id'] = $row['Id'];
                    
                    // Check the user's role
                    if($row['role'] == 'admin') {
                        header("Location: Admindashboard.php");
                    } else {
                        header("Location: Main.php");
                    }
                    exit();
                } else {
                    $error_message = "Wrong Password!!";
                }
            } else {
                $error_message = "Email not registered!!";
            }
        }
    } else {
        $error_message = "Email and password fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

    <style>
        .not-registered-message {
            margin-top: 20px;
            text-align: center;
        }

        .not-registered-message p {
            font-size: 18px;
        }

        .not-registered-message a {
            color: #007bff; 
            text-decoration: none;
        }

        .not-registered-message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <main>
        <div class="login-container">
            <div class="form-box">
                <h1>Login</h1>
                <?php if(!empty($error_message)) { ?>
                    <div class="message" style="background-color: #f2dede; color: #a94442; border: 1px solid #ebccd1; padding: 15px; margin-bottom: 20px;">
                        <p><?php echo $error_message; ?></p>
                    </div>
                <?php } ?>
                <form action="Login.php" method="post">
                    <div class="input-field">
                        <i class="fa fa-light fa-envelope" aria-hidden="true"></i>
                        <input type="text" name="email" placeholder="Email">
                    </div>

                    <div class="input-field">
                        <i class="fa fa-light fa-lock" aria-hidden="true"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>

                    <div class="btn-field">
                        <button type="submit" name="submit" id="loginbtn">Log In</button>
                    </div>
                </form>

                <div class="not-registered-message">
                    <p>Not Registered? <a href="Register.php">Register Here</a></p>
                </div>
            </div>
        </div>
    </main>
</body>   
</html>