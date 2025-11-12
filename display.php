<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM students ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Records (CRUD)</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #93c5fd, #60a5fa);
            padding: 30px;
        }
        h2 {
            text-align: center;
            color: #1e3a8a;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #2563eb;
            color: white;
        }
        tr:hover {
            background-color: #f1f5f9;
        }
        .btn {
            padding: 6px 12px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }
        .edit {
            background-color: #22c55e;
        }
        .delete {
            background-color: #ef4444;
        }
        .add {
            display: inline-block;
            background-color: #2563eb;
            margin-bottom: 15px;
            text-decoration: none;
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
        }
        .add:hover {
            background-color: #1e40af;
        }
    </style>
</head>
<body>

<h2>🎓 Student Records (CRUD)</h2>
<a href="index.html" class="add">➕ Add New Student</a>

<table>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Course</th>
        <th>Study Mode</th>
        <th>Resume</th>
        <th>Actions</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['firstname']} {$row['lastname']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['course']}</td>
                    <td>{$row['study_mode']}</td>
                    <td><a href='uploads/{$row['resume']}' target='_blank'>View</a></td>
                    <td>
                        <a href='edit.php?id={$row['id']}' class='btn edit'>Edit</a>
                        <a href='delete.php?id={$row['id']}' class='btn delete' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='8' style='text-align:center;'>No records found</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php $conn->close(); ?>
