<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT audit_log.*, users.username FROM audit_log JOIN users ON audit_log.user_id = users.id ORDER BY time_stamp DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Audit Log</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Audit Log (Non-Repudiation)</h2>
        <table>
            <tr><th>ID</th><th>User</th><th>Action</th><th>Details</th><th>Time</th></tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['action']; ?></td>
                <td><?php echo $row['details']; ?></td>
                <td><?php echo $row['time_stamp']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>