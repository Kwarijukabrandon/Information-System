<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_name = trim($_POST['student_name']);
    $programme = trim($_POST['programme']);
    $marks = trim($_POST['marks']);

    // INTEGRITY: SHA-256 hash
    $combined = $student_name . $programme . $marks;
    $hash = hash('sha256', $combined);

    $sql = "INSERT INTO transcripts (student_name, programme, marks, hash_code, created_by)
            VALUES ('$student_name', '$programme', '$marks', '$hash', {$_SESSION['user_id']})";

    if ($conn->query($sql)) {
        // NON-REPUDIATION: log action
        $conn->query("INSERT INTO audit_log (user_id, action, details) VALUES ({$_SESSION['user_id']}, 'ADD_TRANSCRIPT', 'Added transcript for $student_name')");
        echo "<p class='success'>Transcript saved!<br>Hash: $hash</p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Transcript</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Add Transcript</h2>
        <form method="POST">
            <input type="text" name="student_name" placeholder="Student Name" required><br>
            <input type="text" name="programme" placeholder="Programme" required><br>
            <textarea name="marks" placeholder="Marks e.g. Math: 80, English: 75" required></textarea><br>
            <button type="submit" class="btn">Save Transcript</button>
        </form>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>