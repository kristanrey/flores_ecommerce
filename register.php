<?php
include('db_connection.php');

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    $query = "INSERT INTO register (username, password, email) VALUES ('$username', '$password', '$email')";
    if (mysqli_query($conn, $query)) {
        $success = "Registration successful!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="container">
        <form method="POST" action="">
            <h1>Register</h1>

            <!-- Display success or error message -->
            <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required />
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required />
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required />
            </div>

            <button type="submit" class="btn">Register</button>

            <div class="register-link">
                <p>Already have an account? <a href="index.php">Login here</a>.</p>
            </div>
        </form>
    </div>
</body>
</html>
