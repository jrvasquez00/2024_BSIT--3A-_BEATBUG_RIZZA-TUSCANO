<?php
// Including middleware and header
include('../middleware/adminMiddleware.php');
include('includes/header.php');

// Establishing database connection
$conn = connection();

// SQL Query to fetch revenue data for different time periods
$sql_weekly = "SELECT 
                    YEARWEEK(order_date) AS week_number,
                    SUM(products.product_price * orders.qty) AS total_sales
                FROM orders
                JOIN products ON orders.product_id = products.product_id
                WHERE orders.order_phase IN ('4', '5')  -- Consider only Confirmed and Delivered orders
                GROUP BY week_number
                ORDER BY week_number";

$sql_monthly = "SELECT 
                    DATE_FORMAT(order_date, '%Y-%m') AS month,
                    SUM(products.product_price * orders.qty) AS total_sales
                FROM orders
                JOIN products ON orders.product_id = products.product_id
                WHERE orders.order_phase IN ('4', '5')  -- Consider only Confirmed and Delivered orders
                GROUP BY month
                ORDER BY month";

$sql_daily = "SELECT 
                    DATE(order_date) AS date,
                    SUM(products.product_price * orders.qty) AS total_sales
                FROM orders
                JOIN products ON orders.product_id = products.product_id
                WHERE orders.order_phase IN ('4', '5')  -- Consider only Confirmed and Delivered orders
                GROUP BY date
                ORDER BY date";

$sql_yearly = "SELECT 
                    YEAR(order_date) AS year,
                    SUM(products.product_price * orders.qty) AS total_sales
                FROM orders
                JOIN products ON orders.product_id = products.product_id
                WHERE orders.order_phase IN ('4', '5')  -- Consider only Confirmed and Delivered orders
                GROUP BY year
                ORDER BY year";

// Function to execute query and fetch data
function fetchData($conn, $sql) {
    $result = mysqli_query($conn, $sql);
    if ($result === false) {
        echo "Error executing query: " . mysqli_error($conn);
        return [];
    } else {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

// Fetching data for different time periods
$sales_weekly = fetchData($conn, $sql_weekly);
$sales_monthly = fetchData($conn, $sql_monthly);
$sales_daily = fetchData($conn, $sql_daily);
$sales_yearly = fetchData($conn, $sql_yearly);

// Closing database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Revenue Report</title>
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
    </style>
</head>
<body>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Weekly Revenue</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Week</th>
                                <th>Total Sales (PHP)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sales_weekly as $sale): ?>
                                <tr>
                                    <td><?php echo $sale['week_number']; ?></td>
                                    <td><?php echo isset($sale['total_sales']) ? number_format($sale['total_sales'], 2) : '0.00'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Monthly Revenue</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Total Sales (PHP)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sales_monthly as $sale): ?>
                                <tr>
                                    <td><?php echo $sale['month']; ?></td>
                                    <td><?php echo isset($sale['total_sales']) ? number_format($sale['total_sales'], 2) : '0.00'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Daily Revenue</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total Sales (PHP)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sales_daily as $sale): ?>
                                <tr>
                                    <td><?php echo $sale['date']; ?></td>
                                    <td><?php echo isset($sale['total_sales']) ? number_format($sale['total_sales'], 2) : '0.00'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Yearly Revenue</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Total Sales (PHP)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sales_yearly as $sale): ?>
                                <tr>
                                    <td><?php echo $sale['year']; ?></td>
                                    <td><?php echo isset($sale['total_sales']) ? number_format($sale['total_sales'], 2) : '0.00'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </
