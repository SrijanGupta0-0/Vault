<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

include("config/db.php");

$user_id = $_SESSION["user_id"];
$target_dir = "uploads/";
$filename = basename($_FILES["file"]["name"]);
$target_file = $target_dir . $filename;

if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $stmt = $conn->prepare("INSERT INTO files (user_id, filename) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $filename);
    $stmt->execute();
}
header("Location: dashboard.php");
?>
