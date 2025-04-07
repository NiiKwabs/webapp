<?php
include "db.php";
$signup_error = '';
$signup_success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    $check = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $check->bind_param("s", $new_username);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {
        $signup_error = "Username already exists!";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $insert = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $insert->bind_param("ss", $new_username, $hashed_password);
        if ($insert->execute()) {
            $signup_success = "User registered successfully! You can now login.";
        } else {
            $signup_error = "Error during registration!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up | Valley View School</title>
    <style>
        body {
            background: url('assets/bg-login.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .signup-box {
            width: 350px;
            margin: 120px auto;
            padding: 30px;
            background: rgba(255,255,255,0.95);
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            color: #00274D;
            margin-bottom: 20px;
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

        .back-btn {
            background-color: #777;
            margin-top: 15px;
        }

        .back-btn:hover {
            background-color: #555;
        }

        .error {
            color: red;
            font-size: 14px;
            margin: 10px 0;
        }

        .success {
            color: green;
            font-size: 14px;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="signup-box">
    <h2>Sign Up</h2>
    <?php 
        if ($signup_error) echo "<div class='error'>$signup_error</div>";
        if ($signup_success) echo "<div class='success'>$signup_success</div>";
    ?>
    <form method="POST">
        <input type="text" name="new_username" placeholder="New Username" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <button type="submit" name="signup">Create Account</button>
    </form>
    <form action="login.php" method="get">
        <button type="submit" class="back-btn">Back to Login</button>
    </form>
</div>

</body>
</html>
