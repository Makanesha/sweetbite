<?php
include 'db_connect.php';

// Check if 'id' exists in URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Announcement ID is missing.");
}

// Sanitize the ID to prevent SQL injection
$announcement_id = intval($_GET['id']);

// Fetch workshop registrations
$result = $conn->query("SELECT * FROM workshop_registrations WHERE announcement_id = $announcement_id");

if (!$result) {
    die("Database Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Workshop Registrations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f4f4f4;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #00a86b;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .back-button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background: #00a86b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Workshop Registrations</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Availability</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['availability']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="admin_announcements.php" class="back-button">Back to Announcements</a>
</div>

</body>
</html>
