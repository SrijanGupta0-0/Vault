<?php
session_start();
include("config/db.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if username already exists
    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error = "Username already exists. Please choose another.";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            $_SESSION["user_id"] = $stmt->insert_id;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .error-message {
            color: #ff4757;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Create Account</h2>

    <?php if (!empty($error)): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        Username: <input type="text" placeholder="Username" name="username"  required><br><br>
        Password: <input type="password" placeholder="Password" name="password" required><br><br>
        <button type="submit">Register</button>
    </form>
    <a href="index.php">Already have an account?</a>
</div>
</body>
</html>
