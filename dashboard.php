<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?> (<?php echo $_SESSION['role']; ?>)</h2>
        <h3>Actions:</h3>
        <a href="add_transcript.php" class="btn">Add Transcript</a>
        <a href="view_transcript.php" class="btn">View Transcript</a>
        <a href="verify_transcript.php" class="btn">Verify Transcript</a>
        <?php if ($_SESSION['role'] == 'admin'): ?>
            <a href="audit_log.php" class="btn">View Audit Log</a>
        <?php endif; ?>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>