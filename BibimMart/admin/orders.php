<?php
// Including middleware and header
include('../middleware/adminMiddleware.php');
include('includes/header.php');

// Establishing database connection
$conn = connection();

// SQL Query to fetch orders data
$sql = "SELECT 
            orders.order_id, 
            orders.secondary_receiver, 
            orders.secondary_address AS address, 
            GROUP_CONCAT(products.product_name SEPARATOR ', ') AS products, 
            SUM(products.product_price * orders.qty) AS total_price,
            CASE 
                WHEN orders.order_phase = '3' THEN 'Declined'
                WHEN orders.order_phase = '4' THEN 'Confirmed'
                WHEN orders.order_phase = '5' THEN 'Delivered'
                WHEN orders.order_phase = '6' THEN 'Shipped'
                ELSE 'Pending'
            END AS status
        FROM orders
        JOIN users ON orders.customer_id = users.customer_id
        JOIN products ON orders.product_id = products.product_id
        WHERE orders.order_phase = '2'
        GROUP BY orders.order_id, orders.secondary_receiver, orders.secondary_address";

$result = mysqli_query($conn, $sql);

// Check if the query execution was successful
if ($result === false) {
    // Query failed, handle the error
    echo "Error executing query: " . mysqli_error($conn);
    // Set $orders to an empty array to prevent further issues
    $orders = [];
} else {
    // Query succeeded, check the number of rows
    if (mysqli_num_rows($result) > 0) {
        // Fetch all rows and store them in $orders
        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        // No rows returned from the query, set $orders to an empty array
        $orders = [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-confirm {
            background-color: #28a745;
            color: #fff;
        }
        .btn-delivered {
            background-color: #17a2b8;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Orders
                    <a href="orders_history.php" class="btn btn-primary float-end"><i class="material-icons opacity-10">history</i> Orders History</a>
                    </h4> 
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Products</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?php echo $order['order_id']; ?></td>
                                    <td><?php echo isset($order['secondary_receiver']) ? $order['secondary_receiver'] : ''; ?></td>
                                    <td><?php echo isset($order['address']) ? $order['address'] : ''; ?></td>
                                    <td><?php echo isset($order['products']) ? $order['products'] : ''; ?></td>
                                    <td><?php echo isset($order['total_price']) ? number_format($order['total_price'], 2) : ''; ?></td>
                                    <td><?php echo isset($order['status']) ? $order['status'] : ''; ?></td>
                                    <td>
                                        <a href="update_order_phase.php?order_id=<?php echo $order['order_id']; ?>&status=3" class="btn btn-danger">Decline</a>
                                        <a href="update_order_phase.php?order_id=<?php echo $order['order_id']; ?>&status=4" class="btn btn-confirm">Confirm</a>
                                        <a href="update_order_phase.php?order_id=<?php echo $order['order_id']; ?>&status=6" class="btn btn-confirm">Shipped</a>
                                        <a href="update_order_phase.php?order_id=<?php echo $order['order_id']; ?>&status=5" class="btn btn-delivered">Delivered</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
