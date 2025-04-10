<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] !== "admin") {
    header("Location: login.php");
    exit();
}

// Fetch combo course data
$result = $conn->query("SELECT * FROM combo_registration");
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combination Course Registrations</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }
        .navbar {
            background: #333;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>

<?php include ('adminheader.php');?>

    <div class="container">
        <h2>Combination Course Registrations</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Slot</th>
                <th>Age</th>
                <th>Experience</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['slot']) ?></td>
                <td><?= htmlspecialchars($row['age']) ?></td>
                <td><?= htmlspecialchars($row['experience']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

<script>
function toggleDropdown() {
    var dropdown = document.getElementById("courseDropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}
window.onclick = function(event) {
    if (!event.target.matches('.navbar a')) {
        var dropdown = document.getElementById("courseDropdown");
        if (dropdown && dropdown.style.display === "block") {
            dropdown.style.display = "none";
        }
    }
}
</script>

</body>
</html>
