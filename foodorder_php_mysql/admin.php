<?php
include 'db.php';

// Add food item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_food'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "INSERT INTO FoodItems (name, price, description) VALUES ('$name', $price, '$description')";
    $conn->query($sql);
}

// Fetch food items
$foodItems = $conn->query("SELECT * FROM FoodItems");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Admin Panel</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Food Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <textarea name="description" placeholder="Description"></textarea>
        <button type="submit" name="add_food">Add Food Item</button>
    </form>
    <h2>Menu</h2>
    <ul>
        <?php while ($item = $foodItems->fetch_assoc()) : ?>
            <li><?= $item['name'] ?> - $<?= $item['price'] ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
