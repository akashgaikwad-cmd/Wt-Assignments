<?php
include 'db.php';

// Place an order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    $customerName = $_POST['customer_name'];
    
    // Check if food_ids is set and is an array
    if (isset($_POST['food_ids']) && is_array($_POST['food_ids'])) {
        $foodIds = implode(',', $_POST['food_ids']);
        $totalPrice = $_POST['total_price']; // Price calculated on the frontend
    } else {
        $foodIds = ''; // No items selected
        $totalPrice = 0.00;
    }

    // Insert the order into the database
    $sql = "INSERT INTO Orders (customer_name, order_details, total_price) VALUES ('$customerName', '$foodIds', $totalPrice)";
    if ($conn->query($sql)) {
        echo "<p>Order placed successfully!</p>";
    } else {
        echo "<p>Error placing order: " . $conn->error . "</p>";
    }
}

// Fetch food items from the database
$menu = $conn->query("SELECT * FROM FoodItems");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Food</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Function to update total price dynamically
        function updateTotalPrice() {
            let total = 0;
            document.querySelectorAll('.food-item').forEach(item => {
                if (item.checked) {
                    total += parseFloat(item.dataset.price);
                }
            });
            document.getElementById('total-price').value = total.toFixed(2);
        }
    </script>
</head>
<body>
    <h1>Order Food</h1>
    <form method="POST">
        <input type="text" name="customer_name" placeholder="Your Name" required>
        <h2>Menu</h2>
        <?php while ($item = $menu->fetch_assoc()) : ?>
            <div>
                <input type="checkbox" 
                       class="food-item" 
                       name="food_ids[]" 
                       value="<?= $item['id'] ?>" 
                       data-price="<?= $item['price'] ?>" 
                       onchange="updateTotalPrice()">
                <?= $item['name'] ?> - $<?= $item['price'] ?>
            </div>
        <?php endwhile; ?>
        <div>
            <label>Total Price: $</label>
            <input type="text" id="total-price" name="total_price" value="0.00" readonly>
        </div>
        <button type="submit" name="place_order">Place Order</button>
    </form>
</body>
</html>
