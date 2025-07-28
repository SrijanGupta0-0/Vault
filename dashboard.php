<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

include("config/db.php");
$user_id = $_SESSION["user_id"];

// Fetch files
$stmt = $conn->prepare("SELECT * FROM files WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Your Secure File Vault</h2>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    <h3>Your Files:</h3>
    <div class="file-list">
    <?php while ($row = $result->fetch_assoc()): 
        $filename = htmlspecialchars($row['filename']);
        $filepath = "uploads/" . $filename;
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    ?>
        <div class="file-card">
            <strong><?= $filename ?></strong><br>
            <small><?= $row['uploaded_at'] ?></small><br><br>

            <?php if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])): ?>
                <img src="<?= $filepath ?>" class="preview-img">

            <?php elseif ($ext === 'pdf'): ?>
                <iframe src="<?= $filepath ?>" class="preview-pdf"></iframe>

            <?php elseif (in_array($ext, ['txt', 'log', 'csv', 'json', 'html'])): ?>
                <iframe src="<?= $filepath ?>" class="preview-text"></iframe>

            <?php elseif (in_array($ext, ['mp3', 'wav', 'ogg'])): ?>
                <audio controls>
                    <source src="<?= $filepath ?>" type="audio/<?= $ext ?>">
                    Your browser does not support the audio element.
                </audio>

            <?php elseif (in_array($ext, ['mp4', 'webm', 'ogv'])): ?>
                <video width="100%" height="150" controls>
                    <source src="<?= $filepath ?>" type="video/<?= $ext ?>">
                    Your browser does not support the video tag.
                </video>

            <?php else: ?>
                <p class="file-type-text">Preview not available for this file type.</p>
            <?php endif; ?>

            <br>
            <a href="download.php?file=<?= urlencode($filename) ?>">Download</a> |
            <a href="delete.php?file=<?= urlencode($filename) ?>" onclick="return confirm('Delete this file?')">Delete</a>
        </div>
    <?php endwhile; ?>
    </div>

    <br><a href="logout.php">Logout</a>
</div>
</body>
</html>
