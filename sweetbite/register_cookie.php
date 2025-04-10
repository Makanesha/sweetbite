<?php
$conn = new mysqli('localhost', 'root', '', 'sweetbite');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO cookie_registration (name, email, phone, slot, age, experience) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssis", $name, $email, $phone, $slot, $age, $experience);

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$slot = $_POST['slot'];
$age = $_POST['age'];
$experience = $_POST['experience'];

if($stmt->execute()){
    echo "<script>alert('You have registered for Cookie Course Successfully!  New batches starts next month'); window.location.href='course.html';</script>";
}else{
    echo "<script>alert('Registration Failed! Please try again.'); window.location.href='course.php';</script>";
}

$stmt->close();
$conn->close();
?>
