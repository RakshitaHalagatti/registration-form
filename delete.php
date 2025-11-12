<?php
$conn = new mysqli("localhost","root","","registration_db");

$id = $_GET['id'];

$conn->query("DELETE FROM students WHERE id=$id");

echo "<script>alert('Record Deleted'); window.location='display.php';</script>";
?>
