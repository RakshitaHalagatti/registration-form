<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        a {
            color: blue;
        }
    </style>
</head>
<body>

<h2>Student Registrations</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>GitHub</th>
        <th>LinkedIn</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
            echo "<td>".$row['email']."</td>";

            // ✅ Make GitHub Clickable
            if (!empty($row['github'])) {
                echo "<td><a href='".$row['github']."' target='_blank'>Open GitHub</a></td>";
            } else {
                echo "<td>Not Provided</td>";
            }

            // ✅ Make LinkedIn Clickable
            if (!empty($row['linkedin'])) {
                echo "<td><a href='".$row['linkedin']."' target='_blank'>Open LinkedIn</a></td>";
            } else {
                echo "<td>Not Provided</td>";
            }

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No Records Found</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php $conn->close(); ?>
