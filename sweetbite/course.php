<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        /* Include all your CSS styles here (already present) */
        .course-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 50px;
        }
        .flip-card {
            background-color: transparent;
            width: 250px;
            height: 320px;
            perspective: 1000px;
        }
        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.8s;
            transform-style: preserve-3d;
            cursor: pointer;
        }
        .flip-card.flipped .flip-card-inner {
            transform: rotateY(180deg);
        }
        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background: #fff;
        }
        .flip-card-front {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .flip-card-front img {
            width: 80%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
        .flip-card-front h3 {
            margin: 15px 0 5px 0;
        }
        .flip-card-front span {
            font-size: 14px;
            color: #555;
        }
        .flip-card-back {
            transform: rotateY(180deg);
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
        }
        .flip-card-back p {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .register-btn {
            padding: 8px 16px;
            background: #00a86b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .register-btn:hover {
            background: #008f5a;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: left;
            width: 400px;
        }
        .modal-content h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .modal-content label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        .modal-content input, .modal-content select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .modal-content button {
            margin-top: 15px;
            background: #00a86b;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal-content button:hover {
            background: #008f5a;
        }
        .close-btn {
            float: right;
            font-size: 20px;
            cursor: pointer;
            color: #999;
        }
        .close-btn:hover {
            color: #333;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<?php include ('header.php');?>

<main>
    <section class="menu section bd-container" id="menu">
        <span class="section-subtitle">Courses</span>
        <h2 class="section-title">Courses for the Month</h2>

        <div class="course-container">
            <!-- Cake Course -->
            <div class="flip-card" onclick="this.classList.toggle('flipped')">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="assets/img/cake4.png" alt="Cake">
                        <h3 class="menu__name">Cake Courses</h3>
                        <span class="menu__detail">1 month </span>
                        <span class="menu__preci">Rs.5,000.00</span><br>
                        <button class="register-btn" onclick="openModal('cakeModal')">Register</button><br>
                    </div>
                    <div class="flip-card-back">
                        <p>Learn professional cake baking techniques from scratch with certification.</p>
                        <button class="register-btn" onclick="openModal('cakeModal')">Register</button>
                    </div>
                </div>
            </div>

            <!-- Cookie Course -->
            <div class="flip-card" onclick="this.classList.toggle('flipped')">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="assets/img/cookie.png" alt="Cookies">
                        <h3 class="menu__name">Cookie Courses</h3>
                        <span class="menu__detail">2 weeks </span>
                        <span class="menu__preci">Rs.3,000.00</span><br>
                        <button class="register-btn" onclick="openModal('cookieModal')">Register</button><br>
                    </div>
                    <div class="flip-card-back">
                        <p>Master the art of cookie baking with expert guidance.</p>
                        <button class="register-btn" onclick="openModal('cookieModal')">Register</button>
                    </div>
                </div>
            </div>

            <!-- Pastry Course -->
            <div class="flip-card" onclick="this.classList.toggle('flipped')">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="assets/img/pizza1.png" alt="Savoury">
                        <h3 class="menu__name">Pastry Courses</h3>
                        <span class="menu__detail">1 month </span>
                        <span class="menu__preci">Rs.6,000.00</span><br>
                        <button class="register-btn" onclick="openModal('pastryModal')">Register</button><br>
                    </div>
                    <div class="flip-card-back">
                        <p>Learn to prepare savory baked goods like quiches, pizzas and more.</p>
                        <button class="register-btn" onclick="openModal('pastryModal')">Register</button>
                    </div>
                </div>
            </div>

            <!-- Combination Course -->
            <div class="flip-card" style="width: 520px; height: 350px;" onclick="this.classList.toggle('flipped')">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="assets/img/combine.png" alt="Combo" style="width:90%; height:180px;">
                        <h3 class="menu__name">Combination Course</h3>
                        <span class="menu__detail">2 Months</span>
                        <span class="menu__preci">Rs.10,000.00</span><br>
                        <button class="register-btn" onclick="openModal('comboModal')">Register</button><br>
                    </div>
                    <div class="flip-card-back">
                        <p>Complete package combining Cake, Cookie, and Savoury Courses with certification.</p>
                        <button class="register-btn" onclick="openModal('comboModal')">Register</button>
                    </div>
                </div>
            </div>

        </div>

    </section>
</main>

<!-- Registration Modals -->
<div id="cakeModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('cakeModal')">&times;</span>
        <h2>Register for Cake Course</h2>
        <form action="register_cake.php" method="post" onsubmit="return validateForm(this)">
            <label>Name:</label><input type="text" name="name" required pattern="[A-Za-z ]+">
            <label>Email ID:</label><input type="email" name="email" required>
            <label>Phone Number:</label><input type="tel" name="phone" pattern="[0-9]{10}" required>
            <label>Slot Selection:</label>
            <select name="slot" required>
                <option value="">--Select--</option>
                <option value="weekday9-12">Weekday 9-12</option>
                <option value="weekday2-5">Weekday 2-5</option>
                <option value="weekend9-12">Weekend 9-12</option>
                <option value="weekend2-5">Weekend 2-5</option>
            </select>
            <label>Age:</label><input type="number" name="age" min="15" required>
            <label>Previous Baking Experience:</label>
            <select name="experience" required>
                <option value="">--Select--</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

<div id="cookieModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('cookieModal')">&times;</span>
        <h2>Register for Cookie Course</h2>
        <form action="register_cookie.php" method="post" onsubmit="return validateForm(this)">
            <label>Name:</label><input type="text" name="name" required pattern="[A-Za-z ]+">
            <label>Email ID:</label><input type="email" name="email" required>
            <label>Phone Number:</label><input type="tel" name="phone" pattern="[0-9]{10}" required>
            <label>Slot Selection:</label>
            <select name="slot" required>
                <option value="">--Select--</option>
                <option value="weekday9-12">Weekday 9-12</option>
                <option value="weekday2-5">Weekday 2-5</option>
                <option value="weekend9-12">Weekend 9-12</option>
                <option value="weekend2-5">Weekend 2-5</option>
            </select>
            <label>Age:</label><input type="number" name="age" min="15" required>
            <label>Previous Baking Experience:</label>
            <select name="experience" required>
                <option value="">--Select--</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

<div id="pastryModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('pastryModal')">&times;</span>
        <h2>Register for Pastry Course</h2>
        <form action="register_pastry.php" method="post" onsubmit="return validateForm(this)">
            <label>Name:</label><input type="text" name="name" required pattern="[A-Za-z ]+">
            <label>Email ID:</label><input type="email" name="email" required>
            <label>Phone Number:</label><input type="tel" name="phone" pattern="[0-9]{10}" required>
            <label>Slot Selection:</label>
            <select name="slot" required>
                <option value="">--Select--</option>
                <option value="weekday9-12">Weekday 9-12</option>
                <option value="weekday2-5">Weekday 2-5</option>
                <option value="weekend9-12">Weekend 9-12</option>
                <option value="weekend2-5">Weekend 2-5</option>
            </select>
            <label>Age:</label><input type="number" name="age" min="15" required>
            <label>Previous Baking Experience:</label>
            <select name="experience" required>
                <option value="">--Select--</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

<div id="comboModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('comboModal')">&times;</span>
        <h2>Register for Combination Course</h2>
        <form action="register_combo.php" method="post" onsubmit="return validateForm(this)">
            <label>Name:</label><input type="text" name="name" required pattern="[A-Za-z ]+">
            <label>Email ID:</label><input type="email" name="email" required>
            <label>Phone Number:</label><input type="tel" name="phone" pattern="[0-9]{10}" required>
            <label>Slot Selection:</label>
            <select name="slot" required>
                <option value="">--Select--</option>
                <option value="weekday9-12">Weekday 9-12</option>
                <option value="weekday2-5">Weekday 2-5</option>
                <option value="weekend9-12">Weekend 9-12</option>
                <option value="weekend2-5">Weekend 2-5</option>
            </select>
            <label>Age:</label><input type="number" name="age" min="15" required>
            <label>Previous Baking Experience:</label>
            <select name="experience" required>
                <option value="">--Select--</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

<script>
function openModal(id) {
    event.stopPropagation();
    document.getElementById(id).style.display = 'flex';
}
function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}
function validateForm(form) {
    const phone = form.phone.value;
    if (!/^\d{10}$/.test(phone)) {
        alert("Phone number must be 10 digits");
        return false;
    }
    return true;
}
window.onclick = function(event) {
    document.querySelectorAll('.modal').forEach(modal => {
        if (event.target === modal) modal.style.display = "none";
    });
}
</script>

</body>
</html>
