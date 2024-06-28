<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>

        <link rel="stylesheet" href="Style.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>
<body></body>
    <main>
        <div class="register-container">
            <div class="form-box">
                <h1>Register</h1>
                <?php
                    include("C:/xampp/htdocs/sumazon1/Connection.php");

                    if(isset($_POST['submit']))
                    {
                        // Check if form fields are empty
                            if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['address']) || empty($_POST['phone_number']) || empty($_POST['password'])) {
                                echo "<div class='message'style='background-color: #f2dede; color: #a94442; border: 1px solid #ebccd1; padding: 15px; margin-bottom: 20px;'>
                                        <p>Please fill out all the required fields!!!</p>
                                    </div> <br>";
                                echo "<a href='javascript:self.history.back()'><button class='btn'  style='background-color: #d9534f; color: white; border: none; padding: 10px 20px; cursor: pointer;'>Go Back</button>";
                    } else {
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $address = $_POST['address'];
                        $phone = $_POST['phone_number'];
                        $password = $_POST['password'];
            
                     //verifying the unique email
            
                     $verify_query = mysqli_query($conn,"SELECT Email FROM users WHERE Email='$email'");
            
                     if(mysqli_num_rows($verify_query) !=0 ){
                        echo "<div class='message' style='background-color: #f2dede; color: #a94442; border: 1px solid #ebccd1; padding: 15px; margin-bottom: 20px;'>
                                  <p>This email is used, Try another One Please!</p>
                              </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'  style='background-color: #d9534f; color: white; border: none; padding: 10px 20px; cursor: pointer;'>Go Back</button>";
                     }
                     else{
            
                        mysqli_query($conn,"INSERT INTO users(Username,Address,Phone,Email,Password) VALUES('$username','$address','$phone','$email','$password')") or die("Error Occured");
            
                        echo "<div class='message' style='background-color: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6; padding: 15px; margin-bottom: 20px;'>
                                  <p>Registered successfully!</p>
                              </div> <br>";
                        echo "<a href='Login.php'><button class='btn' style='background-color: #5cb85c; color: white; border: none; padding: 10px 20px; cursor: pointer;'>Login Now</button>";
                     
                     }
            
                    }
                }
                    else{
              ?>
                <form action="Register.php" method="post">
                    <div class="input-group">
                        <div class="input-field" id="namefield">
                            <i class="fa fa-light fa-user" aria-hidden="true"></i>
                            <input type="text" name="username" placeholder="Username">
                        </div>

                        <div class="input-field">
                            <i class="fa fa-light fa-envelope" aria-hidden="true"></i>
                            <input type="email" name="email" placeholder="Email">
                        </div>

                        <div class="input-field">
                            <i class="fa fa-light fa-address-book" aria-hidden="true"></i>
                            <input type="text" name="address" placeholder="Address">
                        </div>

                        <div class="input-field" >
                            <i class="fa fa-light fa-phone" aria-hidden="true"></i>
                            <input type="text" name="phone_number" placeholder="Phone Number">
                        </div>

                        <div class="input-field">
                            <i class="fa fa-light fa-lock" aria-hidden="true"></i>
                            <input type="password" name="password" placeholder="Password">
                        </div>

                        <p>Already Registered? <a href="Login.php">Login</a></p>
                    </div>
                    <div class="btn-field">
                        <button type="submit" id="registerbtn" name="submit">Register</button>
                    </div>
                </form>

              <?php  }
                ?>
        </div>

        <script>
                let registerbtn = document.getElementById("registerbtn");
                let loginbtn = document.getElementById("loginbtn");
                let namefield = document.getElementById("namefield");
        </script>
</body>
</html>