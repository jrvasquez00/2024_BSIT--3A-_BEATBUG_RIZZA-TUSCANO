<?php
session_start();
include_once('../connection/connection.php');

if (!isset($_SESSION['customer_id'])) {
    die("Error: User is not logged in.");
}

$conn = connection();

$sql_get_delivered_orders = "SELECT i.product_name, i.product_price, i.product_desc, i.product_image, o.qty, o.order_date, o.order_id
                             FROM `orders` as o
                             JOIN `products` as i ON o.product_id = i.product_id
                             WHERE o.customer_id=? AND o.order_phase='5'";

$stmt = $conn->prepare($sql_get_delivered_orders);
$stmt->bind_param("i", $_SESSION['customer_id']);
$stmt->execute();
$delivered_results = $stmt->get_result();

if (!$delivered_results) {
    die("Error fetching delivered orders: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Delivered Orders</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
                margin: 0;
                padding: 0;
            }

            header {
                background-color: #36c275;
                color: #fff;
                padding: 1rem 0;
            }

            nav ul {
                list-style: none;
                padding: 0;
                display: flex;
                justify-content: center;
            }

            nav ul li {
                margin: 0 1rem;
            }

            nav ul li a {
                color: #fff;
                text-decoration: none;
                font-weight: bold;
            }

            nav ul li a:hover {
                text-decoration: underline;
            }

            .container {
                max-width: 1250px;
                margin: 2rem auto;
                padding: 10px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 1rem;
            }

            table th, table td {
                padding: 1rem;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            table th {
                background-color: #B1D7B4;
                color: #fff;
                font-weight: bold;
            }

            table tr:nth-child(even) {
                background-color: #B1D7B4;
            }

            table img {
                max-width: 100px;
                height: auto;
                display: block;
            }

            @media (max-width: 768px) {
                nav ul {
                    flex-direction: column;
                    align-items: center;
                }

                table th, table td {
                    display: block;
                    text-align: right;
                }

                table th {
                    display: none;
                }

                table td {
                    padding: 0.5rem;
                    position: relative;
                }

                table td::before {
                    content: attr(data-label);
                    font-weight: bold;
                    position: absolute;
                    left: 0;
                    padding-left: 1rem;
                }

                table img {
                    max-width: 80px;
                }
            }

                .back-button {
                    background-color: transparent; 
                    color: #fff; 
                    position: fixed;
                    border: none;
                    top: 10px;
                    font-size: 16px; 
                    margin-top: 7px;
                    padding-left: 20px
                }

                .top{
                    position: fixed;
                    bottom: 2.1rem;
                    left: 3.0rem;
                }
                .top i {
                    color: #000;
                    background: #fdd1bdf1; 
                    font-size: 14px;
                    padding: 10px;
                    border-radius: 5px;
                }
    </style>
</head>
    <header>
    <nav>
        <ul>
        <li><a href="order.php">My orders</a></li>
            <li><a href="declined_orders.php">Declined Orders</a></li>
            <li><a href="confirmed_orders.php">Confirmed Orders</a></li>
            <li><a href="shipped_orders.php">To shipped Orders</a></li>
            <li><a href="delivered_orders.php">Delivered Orders</a></li>
            <li><a href="cancelled_orders.php">Cancelled Orders</a></li>
        </ul>  
        <button onclick="goBack()" class="back-button"><i class='bx bx-arrow-back'></i> </button> 
    <body>
        </nav> 
    </header>

    <div class="container">
        <div class="delivered-orders">
            <h2>Delivered Orders</h2>
            <?php if ($delivered_results->num_rows > 0) { ?>
                <table>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Order Date</th>
                    </tr>
                    <?php while ($row = $delivered_results->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                            <td>
                                <img src="../uploads/<?php echo htmlspecialchars($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>" style="width:100px;height:auto;">
                            </td>
                            <td><?php echo htmlspecialchars($row['product_price']); ?></td>
                            <td><?php echo htmlspecialchars($row['qty']); ?></td>
                            <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <p>You have no delivered orders.</p>
            <?php } ?>
        </div>
    </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <a href="#" class="top"><i class='bx bx-up-arrow-alt' ></i></i></a>
</body>
</body>
</html>
