<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Items</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            transition: background 0.5s ease;
        }
        .blurred {
            filter: blur(3px);
            pointer-events: none;
        }
        .container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 50px;
        }
        .card {
            background: #fff;
            width: 250px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .btn {
            padding: 10px 16px;
            background: #00a86b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            margin-top: 10px;
        }
        .btn:hover {
            background: #008f5a;
            transform: scale(1.05);
        }
        #popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        #popup {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: scale(0.9);
            transition: transform 0.3s ease-out;
        }
        #popup.show {
            transform: scale(1);
        }
        #popup input {
            width: 60px;
            text-align: center;
            font-size: 16px;
            margin: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #order-summary {
            margin-top: 20px;
            padding: 10px;
            background: #f4f4f4;
            border-radius: 5px;
            text-align: center;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        #order-msg {
            font-size: 14px;
            font-weight: bold;
            color: red;
        }
        .remove-btn {
            background-color: #ff4d4d;
            border: none;
            border-radius: 20px;
            color: white;
            padding: 6px 12px;
            margin-left: 10px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease, transform 0.2s;
            float: right;
        }
        .remove-btn:hover {
            background-color: #cc0000;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <main id="content">
        <section class="menu section bd-container" id="menu">
            <span class="section-subtitle">Order Items</span>
            <h2 class="section-title">Available Items</h2>
            <div class="container">
                <?php
                include 'db_connect.php';
                $result = $conn->query("SELECT * FROM items");
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='card'>
                            <h3>" . $row['name'] . "</h3>
                            <span>Rs." . $row['price'] . "</span><br>
                            <button class='btn' onclick='showPopup(" . $row['id'] . ", \"" . $row['name'] . "\", " . $row['price'] . ")'>Add to Cart</button>
                          </div>";
                }
                $conn->close();
                ?>
            </div>

            <div id="order-summary">
                <h3>Order Summary</h3>
                <div id="summary-list"></div>
                <h4 id="total-cost">Total: ₹0</h4>
                <p id="order-msg">Orders below ₹3000 will not be accepted</p>
                <button id="place-order-btn" class="btn" onclick="confirmOrder()" disabled>
                    Place Order via WhatsApp
                </button>
            </div>
        </section>
    </main>

    <div id="popup-overlay">
        <div id="popup">
            <h3>Enter Quantity</h3>
            <input type="number" id="quantity-input" min="1" value="1">
            <br>
            <button class="btn" onclick="confirmQuantity()">Confirm</button>
            <button class="btn" onclick="closePopup()" style="background: red;">Cancel</button>
        </div>
    </div>

    <div id="whatsapp-popup-overlay" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); backdrop-filter: blur(5px); align-items: center; justify-content: center; z-index: 1000;">
        <div id="popup">
            <h3>Send this order to Sweet Bite on WhatsApp?</h3>
            <button class="btn" onclick="sendOrderViaWhatsApp()">Allow</button>
            <button class="btn" onclick="closeWhatsAppPopup()" style="background:red;">Cancel</button>
        </div>
    </div>

    <script>
        let cart = [];
        let currentItem = {};

        function showPopup(id, name, price) {
            currentItem = { id, name, price };
            document.getElementById("quantity-input").value = 1;
            document.getElementById("popup-overlay").style.display = "flex";
            document.getElementById("popup").classList.add("show");
            document.getElementById("content").classList.add("blurred");
        }

        function closePopup() {
            document.getElementById("popup-overlay").style.display = "none";
            document.getElementById("popup").classList.remove("show");
            document.getElementById("content").classList.remove("blurred");
        }

        function confirmQuantity() {
            let quantity = parseInt(document.getElementById("quantity-input").value);
            if (quantity < 1) {
                alert("Quantity must be at least 1");
                return;
            }

            let index = cart.findIndex(i => i.id === currentItem.id);
            if (index !== -1) {
                cart[index].quantity = quantity; // Replace old quantity
            } else {
                cart.push({ ...currentItem, quantity });
            }

            closePopup();
            updateSummary();
        }

        function removeItem(id) {
            cart = cart.filter(item => item.id !== id);
            updateSummary();
        }

        function updateSummary() {
            let total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            let summaryDiv = document.getElementById("summary-list");
            let totalCostDiv = document.getElementById("total-cost");
            let orderMsg = document.getElementById("order-msg");
            let orderBtn = document.getElementById("place-order-btn");

            summaryDiv.innerHTML = cart.map(item =>
                `<p>${item.name} x${item.quantity} - ₹${item.price * item.quantity}
                <span class="remove-btn" onclick="removeItem(${item.id})">X</span></p>`
            ).join('');

            totalCostDiv.innerHTML = `<h4>Total: ₹${total}</h4>`;
            orderMsg.innerText = total < 3000 ? "Orders below ₹3000 will not be accepted" : "Ready to place order!";
            orderMsg.style.color = total < 3000 ? "red" : "green";

            orderBtn.disabled = total < 3000;
        }

        function confirmOrder() {
            document.getElementById("whatsapp-popup-overlay").style.display = "flex";
            document.getElementById("popup").classList.add("show");
            document.getElementById("content").classList.add("blurred");
        }

        function closeWhatsAppPopup() {
            document.getElementById("whatsapp-popup-overlay").style.display = "none";
            document.getElementById("popup").classList.remove("show");
            document.getElementById("content").classList.remove("blurred");
        }

        function sendOrderViaWhatsApp() {
            let message = "🍰 *Sweet Bite Order Summary*:%0A";
            cart.forEach(item => {
                message += `- ${item.name} x${item.quantity} = ₹${item.price * item.quantity}%0A`;
            });
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            message += `%0A*Total: ₹${total}*%0AOrder from Sweet Bite Website`;

            const phone = "919360027871"; // replace with actual number
            const url = `https://wa.me/${phone}?text=${message}`;

            window.open(url, '_blank');
            closeWhatsAppPopup();
        }
    </script>
</body>
</html>
