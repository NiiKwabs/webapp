<?php
session_start();
include "db.php";

$login_error = '';

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    $welcome_message = "Welcome to the Management System! ";
} else {
    $welcome_message = '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            $login_error = "Invalid password!";
        }
    } else {
        $login_error = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Valley View School</title>
    <style>
        body {
            background: url('assets/bg-login.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 350px;
            padding: 30px;
            background: rgba(255,255,255,0.9);
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #00274D;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            padding: 12px;
            margin-top: 10px;
            background-color: #00509e;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #003f7f;
        }

        .signup-btn {
            background-color: #777;
            margin-top: 15px;
        }

        .signup-btn:hover {
            background-color: #555;
        }

        .error {
            color: red;
            font-size: 14px;
            margin: 10px 0;
        }

        .welcome-message {
            color: green;
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <!-- Display welcome message if logged in -->
    <?php if ($welcome_message) echo "<div class='welcome-message'>$welcome_message</div>"; ?>
    
    <h2>Login</h2>
    <?php if ($login_error) echo "<div class='error'>$login_error</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <form action="signup.php" method="get">
        <button type="submit" class="signup-btn">Go to Sign Up</button>
    </form>
</div>

</body>
</html>
