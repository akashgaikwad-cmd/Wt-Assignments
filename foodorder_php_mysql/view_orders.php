<?php
include 'db.php';

// Fetch orders
$orders = $conn->query("SELECT * FROM Orders");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>View Orders</h1>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Order Details</th>
                <th>Total Price</th>
                <th>Order Time</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = $orders->fetch_assoc()) : ?>
                <tr>
                    <td><?= $order['customer_name'] ?></td>
                    <td><?= $order['order_details'] ?></td>
                    <td>$<?= $order['total_price'] ?></td>
                    <td><?= $order['order_time'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
