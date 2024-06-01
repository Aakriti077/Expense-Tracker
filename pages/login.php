<?php
require_once '../db.php';

$error_message = ''; // Initialize the error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Check if email and password are provided
    if (empty($email) || empty($password)) {
        $error_message = "Please provide both email and password.";
    } else {
        // Check if email exists in the database
        $check_query = "SELECT id, name, password FROM users WHERE email=?";
        $stmt = mysqli_prepare($conn, $check_query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            // check password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                // if password is correct, start session, set session variables
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name']; 
                header("Location: ../index.php");
                exit;
            } else {
                $error_message = "Wrong password.";
            }
        } else {
            $error_message = "User is not registered.";
        }
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../inc/css/login.css">
</head>
<body>
    <div class="container">
        <div class="heading">Login</div>
       
        <form action="../pages/login.php" class="form" method="POST" id="loginForm">
            <input required="" class="input" type="email" name="email" id="email" placeholder="E-mail">
            <?php if (!empty($error_message) && strpos($error_message, 'User is not registered') !== false): ?>
                <span class="error-message"><?php echo $error_message; ?></span>
            <?php endif; ?>
            <input required="" class="input" type="password" name="password" id="password" placeholder="Password">
            <?php if (!empty($error_message) && strpos($error_message, 'Wrong password') !== false): ?>
                <span class="error-message"><?php echo $error_message; ?></span>
            <?php endif; ?>
            <span class="forgot-password"><a href="#">Forgot Password ?</a></span>
            <input class="login-button" type="submit" value="Log In">
        </form>

        <?php if (!empty($error_message) && (strpos($error_message, 'User is not registered') === false && strpos($error_message, 'Wrong password') === false)): ?>
            <span class="error-message"><?php echo $error_message; ?></span>
        <?php endif; ?>

        <div class="register-link">
            <p>Don't have an account? <a href="./signup.php">Register</a></p>
        </div>
    </div>
</body>
</html>