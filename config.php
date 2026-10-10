<?php
$host = "localhost";
$user = "root";          // change to your MySQL username
$pass = "";              // change to your MySQL password
$dbname = "transcript_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>