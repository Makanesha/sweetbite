<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $announcement_id = $_POST['announcement_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $availability = $_POST['availability'];

    // Insert the booking into the database
    $stmt = $conn->prepare("INSERT INTO workshop_registrations (announcement_id, name, email, phone, availability) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $announcement_id, $name, $email, $phone, $availability);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Registration successful!'); window.location.href='announcement.php';</script>";
}
?>
