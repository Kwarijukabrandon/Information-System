<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $student_name = trim($_POST['student_name']);
    $programme = trim($_POST['programme']);
    $marks = trim($_POST['marks']);

    $result = $conn->query("SELECT * FROM transcripts WHERE id=$id");
    $row = $result->fetch_assoc();

    if ($row) {
        $combined = $student_name . $programme . $marks;
        $hash = hash('sha256', $combined);

        if ($hash == $row['hash_code']) {
            echo "<p class='success'>✅ VERIFIED: Transcript is authentic and has not been changed.</p>";
        } else {
            echo "<p class='error'>❌ NOT VERIFIED: Transcript has been tampered with or details are wrong!</p>";
        }
    } else {
        echo "<p class='error'>Transcript not found.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Verify Transcript</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Verify Transcript</h2>
        <form method="POST">
            <input type="number" name="id" placeholder="Transcript ID" required><br>
            <input type="text" name="student_name" placeholder="Student Name" required><br>
            <input type="text" name="programme" placeholder="Programme" required><br>
            <textarea name="marks" placeholder="Marks" required></textarea><br>
            <button type="submit" class="btn">Verify</button>
        </form>
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>