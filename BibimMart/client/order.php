<?php
session_start();
include_once('../connection/connection.php');

$conn = connection();

// Check if customer_id is set in the session
$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null;

if ($customer_id !== null) {
    $sql_get_user_order = "SELECT DISTINCT 
                                o.order_ref_number,
                                pm.payment_method_desc,
                                o.payment_method,
                                op.order_phase_desc,
                                o.order_phase,
                                o.secondary_receiver,
                                o.secondary_address,
                                o.gcash_ref_num,
                                o.gcash_acc_name,
                                o.gcash_acc_num,
                                o.gcash_amt_sent
                            FROM `orders` as o
                            JOIN `payment_method` as pm ON o.payment_method = pm.payment_method_id
                            JOIN `order_phase` as op ON o.order_phase = op.order_phase_id
                            WHERE o.customer_id = '$customer_id'";

    $result_orders = mysqli_query($conn, $sql_get_user_order);

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <title>Order tracking </title>
        <link rel="stylesheet" href="style.css"> 
      
      <style>  
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
          
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                color: #333;
            }

            .container {
                max-width: 1000px;
                margin: 0 auto;
                padding: 20px;
                margin-top: 10px;
            }

            .card {
                background-color: #B1D7B4;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-bottom: 20px;
                max-width: 500px;
            }

            .card-title {
                font-size: 22px;
                font-weight: bold;
                margin-bottom: 10px;
            }


            .badge {
                padding: 6px 10px;
                border-radius: 20px;
                font-size: 14px;
                font-weight: bold;
                
            }

            .btn-danger {
                background-color: #B1D7B4;
                border-color: #dc3545;
                color: #ff8c4e;
                padding: 0.1px 3px;
                border-radius: 5px;
                text-decoration: none;
            }


            .list-group-item {
                padding: 10px 0;
                border-bottom: 1px solid #eee;
                background-color: #d2e7d4;
            }

            .list-group-item img {
                width: 60px;
                height: 60px;
                border-radius: 5%;
            }

            .list-group-item img:hover {
                transform: translateX(-3px); 
                transition: transform 0.2s ease; 
            }
            
            .card-footer {
                border-top: 1px solid #eee;
                padding-top: 15px;
                font-size: 14px;
            }

            
            .card-footer hr {
                border: none;
                border-top: 1px solid #ccc;
                margin: 20px 0;
            }

            .card-footer b {
                color: #007bff;
            }

            .column{
                list-style: none;
                padding: 0;
                display: flex;
                gap: 10px;
                margin-right: 400px;
            }

            .column li {
                margin: 0 9px; 
                border: 1px solid #ccc; 
                border-radius: 5px;
                padding: 10px; 
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 400px;
            }

            .small {
                margin-right: 12px;
            }

            nav ul {
                list-style-type: none;
                padding: 0px;
                margin: 0;
                display: flex;
                justify-content: center;
                background-color: #36c275;
            }

            nav ul li a {
                display: block;
                padding: 1rem 2rem;
                color: #fff;
                text-decoration: none;
                font-weight: bold;
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            nav ul li a:hover {
                background-color: #2c9437;
                color: #e0e0e0;
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
        </style>
    </head>
    <body>
            <nav>
            <ul>
            <li><a href="order.php">My orders</a></li>
            <li><a href="declined_orders.php">Declined Orders</a></li>
            <li><a href="confirmed_orders.php">Confirmed Orders</a></li>
            <li><a href="shipped_orders.php">To shipped Orders</a></li>
            <li><a href="delivered_orders.php">Delivered Orders</a></li>
            <li><a href="cancelled_orders.php">Cancelled Orders</a></li>
            </ul>
        </nav>
        <button onclick="goBack()" class="back-button"><i class='bx bx-arrow-back'></i> </button>  
    <div class="container">
            
        <div class="column">
    <?php

    while ($rec = mysqli_fetch_assoc($result_orders)) { //first loop with only the order_reference_number ?>
        <div class="col-3">
            <div class="card mt-3">
                <h6 class="card-title mt-1 ms-1">
                    <?php
                    echo $rec['order_ref_number'];
                    $curr_order_ref_number = $rec['order_ref_number'];
                    ?>
                    <div class="float-end">
                        <span class="badge rounded-pill text-bg-success"><?php echo $rec['payment_method_desc']; ?></span>
                        <span class="badge rounded-pill 
                                <?php
                                switch ($rec['order_phase']) {
                                    case 0:
                                        echo "text-bg-danger";
                                        break;
                                    case 2:
                                        echo "text-bg-primary";
                                        break;
                                    case 3:
                                        echo "text-bg-info";
                                        break;
                                    case 4:
                                        echo "text-bg-warning";
                                        break;
                                    case 5:
                                        echo "text-bg-success";
                                        break;
                                    default:
                                        echo "text-bg-secondary";
                                }
                                ?> "><?php echo $rec['order_phase_desc']; ?></span>
                        <?php if ($rec['order_phase'] == '2') { ?>
                            <a href="cancel_order.php?cancel_order=<?php echo $rec['order_ref_number']; ?>"
                               class="btn btn-danger btn-sm me-1"> x </a>
                        <?php } ?>
                    </div>
                </h6>
                <?php
                if ($rec['payment_method'] == 1) { ?>
                    <div class="card-caption p-2">
                        <small class="small">Gcash Reference Number: <?php echo $rec['gcash_ref_num']; ?></small> <br>
                        <small class="small">Gcash Account Name: <?php echo $rec['gcash_acc_name']; ?></small> <br>
                        <small class="small">Gcash Account Number: <?php echo $rec['gcash_acc_num']; ?></small> <br>
                        <small class="small">Gcash Amount Sent: <?php echo $rec['gcash_amt_sent']; ?></small>
                    </div>
                <?php }
                ?>
                <?php
                $sql_get_user_item_order = "SELECT 
                                               i.product_name,
                                               i.product_image,
                                               i.product_price,
                                               o.qty
                                           FROM `orders` as o
                                           JOIN `products` as i
                                             ON o.product_id = i.product_id
                                          WHERE o.customer_id = '$customer_id' 
                                            AND o.order_ref_number = '$curr_order_ref_number'";
                $result_item_orders = mysqli_query($conn, $sql_get_user_item_order); ?>
                <div class="list-group">
                    <?php $total_amt = 0.00;
                    while ($io = mysqli_fetch_assoc($result_item_orders)) {
                        $total_amt += ($io['qty'] * $io['product_price']);
                        ?>
                        <li class="list-group-item">
                            <img src="../uploads/<?php echo $io['product_image']; ?>" width="40px" alt="" class="img-fluid"> 
                            <small class="small float-end"> <?php echo "Php " . number_format($io['product_price'], 2); ?></small>                       
                            <?php echo $io['product_name'] . " x "; ?>
                            <?php echo $io['qty'] . " pcs <br>"; ?>
                        </li>
                    <?php } ?>
                </div>
                <div class="card-footer">
                    <span class="float-end"> Total Amount: <b> <?php echo "Php " . number_format($total_amt, 2); ?> </b></span>
                </div>

                <?php if ($rec['secondary_receiver'] != NULL) { ?>
                    <div class="card-footer">
                        <small class="small">
                            <?php echo "Alternate Receiver: " . $rec['secondary_receiver'] . "<br>"; ?>
                            <?php echo "Alternate Address: " . $rec['secondary_address'] . "<br>"; ?>
                        </small>
                    </div>
                <?php } ?>
            </div>
        </div>
        <script>
        function goBack() {
            window.history.back();
        }
        </script>
        </body>
    </html>
    <?php }
}
?>
