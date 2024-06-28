<?php
session_start();

// Handle role selection and redirection
if(isset($_POST['submit'])) {
    $role = $_POST['role'];

    if($role == 'user') {
       
        header("Location: Register.php");
        exit();
    } elseif($role == 'admin') {
        header("Location: Login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Selection</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>
<body>
    <main>
        <div class="background-image">
        <div class="role-selection-container">
            <div class="form-box">
                <h1>Choose Your Role</h1>
                <form method="post">
                    <select class="form-select mb-3" name="role" aria-label="Default select example">
                        <option selected value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <button type="submit" name="submit">Continue</button>
                </form>
            </div>
        </div>
</div>
    </main>
</body>   
</html>