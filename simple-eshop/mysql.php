<?php
$conn = new mysqli("127.0.0.1", "root", "", "dixons");
if ($conn->connect_error) {
    die("MySQL Connection failed: " . $conn->connect_error);
}
?>
