<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$alt_phone = $_POST['alt_phone'];
$gender = $_POST['gender'];
$nationality = $_POST['nationality'];
$pincode = $_POST['pincode'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$course = $_POST['course'];
$study_mode = $_POST['study_mode'];
$skills = $_POST['skills'];
$linkedin = $_POST['linkedin'];
$github = $_POST['github'];
$hobbies = $_POST['hobbies'];
$hear_about = $_POST['hear_about'];

// Handle resume upload
$resume = "";
if (isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0) {
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $resume = basename($_FILES["resume"]["name"]);
    $target_file = $target_dir . $resume;
    move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
}

// SQL insert
$sql = "INSERT INTO students 
    (firstname, lastname, dob, email, phone, alt_phone, gender, nationality, pincode, address, city, state, course, study_mode, skills, linkedin, github, hobbies, hear_about, resume)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("SQL error: " . $conn->error);
}

$stmt->bind_param(
    "ssssssssssssssssssss",
    $firstname, $lastname, $dob, $email, $phone, $alt_phone, $gender,
    $nationality, $pincode, $address, $city, $state, $course, $study_mode,
    $skills, $linkedin, $github, $hobbies, $hear_about, $resume
);

if ($stmt->execute()) {
    // ✅ Redirect to display.php after successful registration
    header("Location: display.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
