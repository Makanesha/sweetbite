<?php
include 'db_connect.php';

session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] !== "admin") {
    header("Location: login.php");
    exit();
}

// Handle form submission for adding an item
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_item"])) {
    $item_name = $_POST["item_name"];
    $item_price = $_POST["item_price"];
    $item_quantity = $_POST["item_quantity"];
    $item_unit = $_POST["item_unit"];

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO items (name, price, quantity, unit) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $item_name, $item_price, $item_quantity, $item_unit);
    $stmt->execute();
    $stmt->close();
    
    header("Location: item_management.php");
    exit();
}

// Handle item update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_item"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $unit = $_POST["unit"];

    // Update the database
    $stmt = $conn->prepare("UPDATE items SET name=?, price=?, quantity=?, unit=? WHERE id=?");
    $stmt->bind_param("sdssi", $name, $price, $quantity, $unit, $id);
    $stmt->execute();
    $stmt->close();
    
    header("Location: item_management.php");
    exit();
}

// Handle item deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM items WHERE id=$id");
    header("Location: item_management.php");
    exit();
}

// Fetch items
$result = $conn->query("SELECT * FROM items");
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Management</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .navbar { background: #333; color: white; padding: 15px; display: flex; justify-content: space-between; }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
        .container { padding: 20px; background: white; border-radius: 2px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; background: white; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .btn { padding: 10px 15px; text-decoration: none; color: white; background: #28a745; border-radius: 4px; border: none; cursor: pointer; }
        .btn-delete { background: red; }
        .input-box { padding: 10px; border: 2px solid #28a745; border-radius: 4px; margin-right: 10px; }
    </style>
    <script>
        function toggleEdit(rowId) {
            let row = document.getElementById("row-" + rowId);
            let inputs = row.getElementsByTagName("input");
            let select = row.getElementsByTagName("select")[0];
            let editButton = document.getElementById("edit-btn-" + rowId);
            let saveButton = document.getElementById("save-btn-" + rowId);

            if (editButton.innerText === "Edit") {
                for (let input of inputs) {
                    input.removeAttribute("readonly");
                }
                select.removeAttribute("disabled");
                editButton.style.display = "none";  
                saveButton.style.display = "inline-block";  
            }
        }
    </script>
</head>
<body>

<?php include ('adminheader.php');?>

<div class="container">
    <h2>Item Management</h2>
    <form method="post" style="display: flex; align-items: center; gap: 10px;">
        <input type="text" name="item_name" class="input-box" placeholder="Item Name" required>
        <input type="number" step="0.01" name="item_price" class="input-box" placeholder="Price" required>
        <input type="number" name="item_quantity" class="input-box" placeholder="Quantity" required>
        <select name="item_unit" class="input-box">
            <option value="piece">Piece</option>
            <option value="g">Gram (g)</option>
            <option value="kg">Kilogram (kg)</option>
        </select>
        <button type="submit" name="add_item" class="btn">Create New Item</button>
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr id="row-<?php echo $row['id']; ?>">
        <form id="form-<?php echo $row['id']; ?>" method="post">
            <td><?php echo $row['id']; ?></td>
            <td><input type="text" name="name" value="<?php echo $row['name']; ?>" class="input-box" readonly></td>
            <td><input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>" class="input-box" readonly></td>
            <td><input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" class="input-box" readonly></td>
            <td>
                <select name="unit" class="input-box" disabled>
                    <option value="piece" <?php echo ($row['unit'] == 'piece') ? 'selected' : ''; ?>>Piece</option>
                    <option value="g" <?php echo ($row['unit'] == 'g') ? 'selected' : ''; ?>>Gram (g)</option>
                    <option value="kg" <?php echo ($row['unit'] == 'kg') ? 'selected' : ''; ?>>Kilogram (kg)</option>
                </select>
            </td>
            <td>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="button" id="edit-btn-<?php echo $row['id']; ?>" class="btn" onclick="toggleEdit(<?php echo $row['id']; ?>)">Edit</button>
                <button type="submit" name="update_item" id="save-btn-<?php echo $row['id']; ?>" class="btn" style="display: none;">Save</button>
                <a href="item_management.php?delete=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </form>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
