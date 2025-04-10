<?php
include 'db_connect.php';

$announcement_id = $_GET['announcement_id'] ?? '';

if (!$announcement_id) {
    die("Invalid workshop selection.");
}

// Fetch workshop details
$stmt = $conn->prepare("SELECT name, date, time FROM announcements WHERE id = ?");
$stmt->bind_param("i", $announcement_id);
$stmt->execute();
$stmt->bind_result($workshop_name, $workshop_date, $workshop_time);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register for Workshop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #00a86b;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Register for <?= htmlspecialchars($workshop_name) ?></h2>
    <p><strong>Date:</strong> <?= htmlspecialchars($workshop_date) ?> | <strong>Time:</strong> <?= htmlspecialchars($workshop_time) ?></p>

    <form action="process_workshop.php" method="POST">
        <input type="hidden" name="announcement_id" value="<?= $announcement_id ?>">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="tel" name="phone" placeholder="Phone Number" required>
        <label>Kindly Confirm your availability on this date?</label>
        <select name="availability" required>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
        <button type="submit">Submit Registration</button>
    </form>
</div>

</body>
</html>
