<?php
include 'db_connect.php';

session_start();
$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        // Registration logic
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $phone, $password);

        if ($stmt->execute()) {
            $_SESSION["user_id"] = $conn->insert_id;
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit();
        } else {
            $message = "❌ Registration failed. Try again.";
            $messageType = "error-message";
        }
        $stmt->close();
    } else {
        // Login logic
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if ($email === 'admin@sweetbite.com' && $password === 'admin@123') {
            $_SESSION["user_id"] = "admin";
            $_SESSION["username"] = "Admin";
            header("Location: admin_dashboard.php");
            exit();
        }

        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            
            if (password_verify($password, $row['password'])) {
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                header("Location: index.php");
                exit();
            } else {
                $message = "❌ Invalid password. Please try again.";
                $messageType = "error-message";
            }
        } else {
            $message = "❌ User not found. Please register.";
            $messageType = "error-message";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <style>
        body {
            font-family: "Amatic SC", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #3CB371, #2E8B57);
        }
        .container {
            background: white;
            padding: 60px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            width: 50%;
            padding: 12px;
            background: #3CB371;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }
        button:hover {
            background: #2E8B57;
        }
        .toggle-btn {
            background: none;
            border: none;
            color: #008000;
            cursor: pointer;
            font-size: 14px;
        }
        .illustration {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>
    <script>
        function toggleForm() {
            let loginForm = document.getElementById("loginForm");
            let registerForm = document.getElementById("registerForm");
            loginForm.style.display = loginForm.style.display === "none" ? "block" : "none";
            registerForm.style.display = registerForm.style.display === "none" ? "block" : "none";
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>SWEETBITE</h1>
        <img src="assets/img/cookie.png" class="illustration" alt="Illustration">
        <?php if (!empty($message)): ?>
            <div class="message <?php echo $messageType; ?>" id="messageBox">
                <?php echo $message; ?>
            </div>
            <script>
                setTimeout(() => { document.getElementById("messageBox").style.display = "none"; }, 3000);
            </script>
        <?php endif; ?>
        
        <div id="loginForm">
            <h2>Login</h2>
            <form method="POST">
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <button class="toggle-btn" onclick="toggleForm()">Register</button></p>
        </div>
        
        <div id="registerForm" style="display: none;">
            <h2>Register</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="text" name="phone" placeholder="Phone Number" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <input type="hidden" name="register" value="1">
                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <button class="toggle-btn" onclick="toggleForm()">Login</button></p>
        </div>
    </div>
</body>
</html>
