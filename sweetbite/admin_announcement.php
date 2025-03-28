<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] !== "admin") {
    header("Location: login.php");
    exit();
}

// Insert Announcement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_announcement'])) {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $fee = $_POST['fee'];
    $place = $_POST['place'];
    $slots = $_POST['slots'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];

    // ✅ Check and create uploads folder if not exists
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $stmt = $conn->prepare("INSERT INTO announcements (name, date, time, fee, place, slots, image, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssdss", $name, $date, $time, $fee, $place, $slots, $image, $description);
    $stmt->execute();
    $stmt->close();
}

// Update Announcement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_announcement'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $fee = $_POST['fee'];
    $place = $_POST['place'];
    $slots = $_POST['slots'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE announcements SET name=?, date=?, time=?, fee=?, place=?, slots=?, description=? WHERE id=?");
    $stmt->bind_param("sssssdsi", $name, $date, $time, $fee, $place, $slots, $description, $id);
    $stmt->execute();
    $stmt->close();
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM announcements WHERE id = $id");
}

// Fetch all
$result = $conn->query("SELECT * FROM announcements");
?>

<!-- ================= UI ================== -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin | Announcements</title>
    <style>
        /* Existing styles */
        body {
            background: #fff;
            color: #111;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
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
            padding: 30px;
            max-width: 1000px;
            margin: auto;
        }
        h2 {
            margin-bottom: 10px;
            font-size: 22px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }
        form {
            background: #fff;
            padding: 20px;
            border: 1px solid #000;
            border-radius: 4px;
            margin-bottom: 40px;
        }
        form label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            font-size: 14px;
        }
        form input, form textarea {
            width: auto;
            padding: 5px;
            border: 1px solid #333;
            border-radius: 2px;
        }
        form button {
            background: #000;
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 3px;
            margin-top: 10px;
            cursor: pointer;
        }
        form button:hover {
            background: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #000;
            color: #fff;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #efefef;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-edit {
            background-color: #007bff;
            color: white;
        }
        .btn-save {
            background-color: #28a745;
            color: white;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        form {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        background: #fff;
        padding: 20px;
        border: 1px solid #000;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    form label {
        display: block;
        margin: 5px 5px;
        font-weight: bold;
        font-size: 14px;
    }

    form input, form textarea {
        width: 100%;
        padding: 0px;
        border: 1px solid #333;
        border-radius: 4px;
        font-size: 14px;
    }

    /* Full width for textarea */
    form textarea {
        grid-column: span 2;
    }

    /* Full width for button */
    form button {
        grid-column: span 2;
        background: linear-gradient(90deg, #4CAF50, #45a049);
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        transition: background 0.3s;
        cursor: pointer;
    }

    form button:hover {
        background: linear-gradient(90deg, #45a049, #4CAF50);
    }

    /* Better buttons */
    .btn {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 13px;
        transition: background 0.3s;
    }
    .btn-edit, .btn-save {
        background: #17a2b8;
        color: white;
    }
    .btn-edit:hover, .btn-save:hover {
        background: #138496;
    }
    .btn-delete {
        background: #e74c3c;
        color: white;
    }
    .btn-delete:hover {
        background: #c0392b;
    }
    /* Add this at the end of your <style> */

.announcements-table {
    margin-top: 40px;
    width: 100%;
    max-width: none;
    padding: 0;         /* Remove form's padding */
    margin-left: 0;     /* Align left */
}

.announcements-table table {
    width: calc(100% - 60px);  /* Adjust if you want spacing */
    margin-left: 30px;    
    margin-right: 30px;      /* Optional to slightly indent */
}

    </style>
</head>
<body>
<div class="navbar">
        <div>
            <a href="admin_dashboard.php">Users</a>
             <!-- Dropdown for Courses -->
        <div style="display: inline-block; position: relative;">
            <a href="#" onclick="toggleDropdown()" style="cursor:pointer;">Courses ▼</a>
            <div id="courseDropdown" style="display:none; position:absolute; background:#333; padding:5px; border-radius:4px;">
                    <a href="course_cake.php" style="display:block; color:white; text-decoration:none; padding:5px;">Cake</a>
                    <a href="course_cookie.php" style="display:block; color:white; text-decoration:none; padding:5px;">Cookie</a>
                    <a href="course_pastry.php" style="display:block; color:white; text-decoration:none; padding:5px;">Pastry</a>
                    <a href="course_combo.php" style="display:block; color:white; text-decoration:none; padding:5px;">Combination</a>
            </div>
        </div>
            <a href="#">Announcements</a>
            <a href="#">Events</a>
        </div>
        <a href="register.php">Logout</a>
    </div>
    <div class="container">
        <h2>Post New Announcement</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Name:</label><input type="text" name="name" required>
            <label>Date:</label><input type="date" name="date" required>
            <label>Time:</label><input type="time" name="time" required>
            <label>Fee:</label><input type="number" name="fee" required>
            <label>Place:</label><input type="text" name="place" required>
            <label>Slots Available:</label><input type="number" name="slots" required>
            <label>Poster Image:</label><input type="file" name="image" accept="image/*" required>
            <label>Description:</label><textarea name="description" rows="4" required></textarea>
            <button type="submit" name="add_announcement">Add Announcement</button>
        </form>
        </div>

        <div class="announcements-table">
        <h2>Existing Announcements</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Poster</th>
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Fee</th>
                <th>Place</th>
                <th>Slots</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <td><?= $row['id'] ?></td>
                        <td><img src="uploads/<?= $row['image'] ?>" width="100"></td>
                        <td><input type="text" name="name" value="<?= $row['name'] ?>"></td>
                        <td><input type="date" name="date" value="<?= $row['date'] ?>"></td>
                        <td><input type="time" name="time" value="<?= $row['time'] ?>"></td>
                        <td><input type="number" name="fee" value="<?= $row['fee'] ?>"></td>
                        <td><input type="text" name="place" value="<?= $row['place'] ?>"></td>
                        <td><input type="number" name="slots" value="<?= $row['slots'] ?>"></td>
                        <td><textarea name="description"><?= $row['description'] ?></textarea></td>
                        <td>
                            <button class="btn btn-save" type="submit" name="update_announcement">Save</button><br><br>
                            <a class="btn btn-delete" href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this announcement?')">Delete</a>
                        </td>
                    </form>
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
