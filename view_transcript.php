<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT transcripts.*, users.username FROM transcripts JOIN users ON transcripts.created_by = users.id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Transcripts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>All Transcripts</h2>
        <table>
            <tr><th>ID</th><th>Student</th><th>Programme</th><th>Marks</th><th>Created By</th><th>Date</th></tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['student_name']; ?></td>
                <td><?php echo $row['programme']; ?></td>
                <td><?php echo $row['marks']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>