<?php
session_start();
include("config/db.php");

if (!isset($_SESSION["user_id"]) || !isset($_GET["file"])) {
    exit("Access denied.");
}

$user_id = $_SESSION["user_id"];
$filename = basename($_GET["file"]);

$stmt = $conn->prepare("SELECT * FROM files WHERE filename = ? AND user_id = ?");
$stmt->bind_param("si", $filename, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    unlink("uploads/" . $filename);
    $del = $conn->prepare("DELETE FROM files WHERE filename = ? AND user_id = ?");
    $del->bind_param("si", $filename, $user_id);
    $del->execute();
}
header("Location: dashboard.php");
?>
