<?php
// Including middleware and header
include('../middleware/adminMiddleware.php');
include('includes/header.php');

// Establishing database connection
$conn = connection();

// SQL Query to fetch orders data excluding 'Pending' orders
$sql = "SELECT 
            orders.order_id, 
            orders.secondary_receiver, 
            orders.secondary_address AS address, 
            GROUP_CONCAT(products.product_name SEPARATOR ', ') AS products, 
            SUM(products.product_price * orders.qty) AS total_price,
            orders.order_date,
            orders.qty,
            orders.payment_method,
            orders.gcash_ref_num,
            orders.gcash_amt_sent,
            CASE 
                WHEN orders.order_phase = '3' THEN 'Declined'
                WHEN orders.order_phase = '4' THEN 'Confirmed'
                WHEN orders.order_phase = '5' THEN 'Delivered'
                ELSE 'Pending'
            END AS status
        FROM orders
        JOIN users ON orders.customer_id = users.customer_id
        JOIN products ON orders.product_id = products.product_id
        WHERE orders.order_phase IN ('3', '4', '5')
        GROUP BY orders.order_id, orders.secondary_receiver, orders.secondary_address, orders.order_date, orders.qty, orders.payment_method, orders.gcash_ref_num, orders.gcash_amt_sent";

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
    <title>Orders History</title>
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
        .card {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
        }
        table th {
            background-color: #f2f2f2;
        }
        .status-declined {
            color: red;
            font-weight: bold;
        }
        .status-confirmed {
            color: green;
            font-weight: bold;
        }
        .status-delivered {
            color: blue;
            font-weight: bold;
        }
        .expanded {
            white-space: normal;
            overflow: visible;
            text-overflow: clip;
            background-color: #2c3e50; /* Dark background color */
            color: white; /* White text color */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Orders History
                    <a href="orders.php" class="btn btn-primary float-end"><i class="material-icons">arrow_back</i> Back</a>
                    </h4> 
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Products</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Qty</th>
                                <th>Pay Method</th>
                                <th>Reference No.</th>
                                <th>Amount Sent</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): 
                                // Determine the status class based on the order status
                                $statusClass = '';
                                if ($order['status'] == 'Declined') {
                                    $statusClass = 'status-declined';
                                } elseif ($order['status'] == 'Confirmed') {
                                    $statusClass = 'status-confirmed';
                                } elseif ($order['status'] == 'Delivered') {
                                    $statusClass = 'status-delivered';
                                }
                                // Convert payment method to readable format
                                $paymentMethod = ($order['payment_method'] == '1') ? 'GCASH' : (($order['payment_method'] == '2') ? 'COD' : '');
                            ?>
                                <tr>
                                    <td><?php echo isset($order['secondary_receiver']) ? $order['secondary_receiver'] : ''; ?></td>
                                    <td><?php echo isset($order['address']) ? $order['address'] : ''; ?></td>
                                    <td><?php echo isset($order['products']) ? $order['products'] : ''; ?></td>
                                    <td><?php echo isset($order['total_price']) ? number_format($order['total_price'], 2) : ''; ?></td>
                                    <td><?php echo isset($order['order_date']) ? $order['order_date'] : ''; ?></td>
                                    <td><?php echo isset($order['qty']) ? $order['qty'] : ''; ?></td>
                                    <td><?php echo $paymentMethod; ?></td>
                                    <td><?php echo isset($order['gcash_ref_num']) ? $order['gcash_ref_num'] : ''; ?></td>
                                    <td><?php echo isset($order['gcash_amt_sent']) ? number_format($order['gcash_amt_sent'], 2) : ''; ?></td>
                                    <td class="<?php echo $statusClass; ?>"><?php echo isset($order['status']) ? $order['status'] : ''; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('table td').forEach(function(cell) {
            cell.addEventListener('click', function() {
                this.classList.toggle('expanded');
            });
        });
    });
</script>

</body>
</html>
