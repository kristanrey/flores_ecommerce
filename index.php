<?php
session_start();
include('db_connection.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM register WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid credentials!";
        }
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="container">
        <form method="POST" action="">
            <h1>Login</h1>

            <!-- Display error message if credentials are invalid -->
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required />
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required />
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox" /> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Sign up here</a>.</p>
            </div>
        </form>
    </div>
</body>
</html>
