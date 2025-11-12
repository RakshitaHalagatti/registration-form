<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $study_mode = $_POST['study_mode'];

    $sql = "UPDATE students SET firstname=?, lastname=?, email=?, phone=?, course=?, study_mode=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $firstname, $lastname, $email, $phone, $course, $study_mode, $id);
    $stmt->execute();

    header("Location: display.php");
    exit;
}

$sql = "SELECT * FROM students WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #e0f2fe;
            padding: 40px;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            width: 400px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        h2 { text-align: center; color: #2563eb; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select {
            width: 100%; padding: 8px; margin-top: 5px;
            border: 1px solid #ccc; border-radius: 6px;
        }
        button {
            width: 100%; background: #2563eb; color: white;
            padding: 10px; border: none; border-radius: 8px;
            margin-top: 15px; cursor: pointer;
        }
        button:hover { background: #1e40af; }
    </style>
</head>
<body>

<h2>✏️ Edit Student Record</h2>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <label>First Name</label>
    <input type="text" name="firstname" value="<?= $row['firstname'] ?>" required>

    <label>Last Name</label>
    <input type="text" name="lastname" value="<?= $row['lastname'] ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= $row['email'] ?>" required>

    <label>Phone</label>
    <input type="text" name="phone" value="<?= $row['phone'] ?>" required>

    <label>Course</label>
    <input type="text" name="course" value="<?= $row['course'] ?>" required>

    <label>Study Mode</label>
    <select name="study_mode">
        <option value="Online" <?= $row['study_mode'] == "Online" ? "selected" : "" ?>>Online</option>
        <option value="Offline" <?= $row['study_mode'] == "Offline" ? "selected" : "" ?>>Offline</option>
        <option value="Hybrid" <?= $row['study_mode'] == "Hybrid" ? "selected" : "" ?>>Hybrid</option>
    </select>

    <button type="submit">💾 Save Changes</button>
</form>

</body>
</html>
