<?php
// This file creates a hashed password for you.
$password = "Dan123";
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Your hashed password is:<br><br>";
echo $hash;
?>
