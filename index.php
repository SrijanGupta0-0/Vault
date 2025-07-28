<?php
session_start();
include("config/db.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashed);
        $stmt->fetch();

        if (password_verify($password, $hashed)) {
            $_SESSION["user_id"] = $id;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Incorrect password. Please try again.";
        }
    } else {
        $error = "Account not found. Please register first.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .error {
            color: red;
            margin-bottom: 10px;
        }
        
    </style>
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        Username: <input type="text" name="username" placeholder="Username" required><br><br>
        Password: <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>

    <a href="register.php">Create new account</a>
</div>

</body>
</html>

