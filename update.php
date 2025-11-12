<?php
$conn = new mysqli("localhost","root","","registration_db");

if ($conn->connect_error) {
    die("Failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$fn = $_POST['firstname'];
$ln = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$course = $_POST['course'];

$query = "UPDATE students SET firstname='$fn', lastname='$ln', email='$email', phone='$phone', course='$course' WHERE id=$id";

if ($conn->query($query)) {
    echo "<script>alert('Updated Successfully'); window.location='display.php';</script>";
} else {
    echo "Update Failed!";
}
?>
