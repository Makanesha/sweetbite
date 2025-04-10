<?php
include 'db_connect.php';

// Fetch announcements
$result = $conn->query("SELECT * FROM announcements ORDER BY date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Announcements</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 60px auto 20px;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .announcement {
            display: flex;
            align-items: center;
            background: #fff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }
        .announcement img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }
        .announcement-content {
            flex: 1;
        }
        .announcement h3 {
            margin: 0;
            font-size: 18px;
            color: #000;
        }
        .announcement p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }
        .announcement .highlight {
            font-weight: bold;
            color: #333;
        }
        .book-now {
            display: inline-block;
            padding: 8px 15px;
            background: #00a86b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .full {
            background: red;
            cursor: not-allowed;
        }
    </style>
</head>
<body>


<?php include ('header.php');?>


<main>
    <section class="menu section bd-container" id="menu">
        <span class="section-subtitle">Announcements</span>
        <h2 class="section-title">Book Your Workshop</h2>

        <div class="course-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <?php 
                // Fetch booked seats
                $announcement_id = $row['id'];
                $slots = $row['slots'];
                $booked = $conn->query("SELECT COUNT(*) AS booked_seats FROM workshop_registrations WHERE announcement_id = $announcement_id");
                $booked_seats = $booked->fetch_assoc()['booked_seats'];
                $available_slots = max(0, $slots - $booked_seats);
            ?>
            <div class="announcement">
                <img src="uploads/<?= $row['image'] ?>" alt="Announcement Poster">
                <div class="announcement-content">
                    <h3><?= $row['name'] ?></h3>
                    <p><span class="highlight">Date:</span> <?= $row['date'] ?> | <span class="highlight">Time:</span> <?= $row['time'] ?></p>
                    <p><span class="highlight">Fee:</span> Rs. <?= $row['fee'] ?> | <span class="highlight">Place:</span> <?= $row['place'] ?></p>
                    <p><span class="highlight">Slots Available:</span> <?= $available_slots ?></p>
                    <p><?= $row['description'] ?></p>

                    <?php if ($available_slots > 0): ?>
                        <a href="workshop_form.php?announcement_id=<?= $announcement_id ?>" class="book-now">Book Now</a>
                    <?php else: ?>
                        <button class="book-now full" disabled>Fully Booked</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    </section>
</main>
</body>
</html>
