<?php

include_once('../connection/connection.php');
include_once('cart.php');

if (!isset($_SESSION['customer_id'])) {
    die("Error: User is not logged in.");
}

if (!isset($_SESSION['users_username']) || !isset($_SESSION['users_address'])) {
    die("Error: User information is incomplete.");
}

$conn = connection();

if (!isset($_GET['order_ids'])) {
    die("Error: No items selected for checkout.");
}

$order_ids = explode(',', $_GET['order_ids']);
$order_number = gen_order_ref_number(8);

$sql_checkout = "SELECT i.product_name, i.product_price, i.product_desc, i.product_image, o.qty, o.order_date, o.order_id, o.product_id
                 FROM `orders` as o
                 JOIN `products` as i ON (o.product_id = i.product_id)
                 WHERE o.customer_id='{$_SESSION['customer_id']}' 
                 AND o.order_phase='1'
                 AND o.order_id IN (" . implode(',', array_map('intval', $order_ids)) . ")";

$result_checkout = mysqli_query($conn, $sql_checkout);

if (!$result_checkout) {
    die("Error fetching checkout data: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.4;
        }

        #checkout {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .alert {
            background-color: #c1f4c6;
            color: black;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #2c9437;
            border-radius: 5px;
            
        }

        .list-group {
            margin-bottom: 20px;
            padding-right: 100px;
        }

        .list-group-item {
            background-color: #f9f9f9;
            border: none;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        form {
            margin-top: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            transition: border-color 0.3s ease;
            background-color: #fdd1bdf1;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            transition: border-color 0.3s ease;
            background-color: #fdd1bdf1;
        }

        .form-select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            margin-left: 970px;
        }

        .btn-warning {
            background-color: #28a745;
            color: #212529;
        }

        .btn-warning:hover {
            background-color: #218838;
        }

        .list-group-item hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }

        .list-group-item b {
            color: #007bff;
        }
    </style>
</head>
<body>
<div id="checkout">
    <div class="alert alert-light">
        Order Reference Number: <?php echo $order_number; ?><br>
        Receiver: <?php echo $_SESSION['users_username']; ?><br>
        Address: <?php echo $_SESSION['users_address']; ?>
    </div>

    <ul class="list-group">
        <?php
        $total_amt = 0.00;
        $cartItems = [];
        while ($co = mysqli_fetch_assoc($result_checkout)) {
            $item_total_price = $co['product_price'] * $co['qty'];
            $total_amt += $item_total_price;
            $cartItems[] = ['product_id' => $co['product_id'], 'quantity' => $co['qty'], 'order_id' => $co['order_id']];
            ?>
            <li class="list-group-item">
                <?php echo $co['product_name'] . " - Php " . number_format($co['product_price'], 2) . " x " . $co['qty'] . " pcs = Php " . number_format($item_total_price, 2); ?>
            </li>
        <?php } ?>

        <li class="list-group-item">
            Total Amount to Pay: <b><?php echo "Php " . number_format($total_amt, 2); ?></b>
        </li>
    </ul>

    <form action="place_order.php" method="post">
        <div class="mt-3">
            <input type="hidden" name="f_total_amt_to_pay" value="<?php echo $total_amt; ?>">
            <input type="hidden" name="f_order_ids" value="<?php echo htmlspecialchars($_GET['order_ids']); ?>">
            <label for="f_alt_receiver">Secondary Receiver Name:</label>
            <input type="text" class="form-control mb-3" placeholder="This is Optional" name="f_alt_receiver" id="f_alt_receiver">
            <label for="f_alt_address">Ship to this Address:</label>
            <input type="text" class="form-control mb-3" placeholder="This is Optional" name="f_alt_address" id="f_alt_address">
            <label for="f_payment_method" class="form-label">Payment Method:</label>
            <select name="f_payment_method" id="f_payment_method" class="form-select mb-3">
                <?php
                $sql_get_payment_method = "SELECT * FROM payment_method";
                $payment_method_result = mysqli_query($conn, $sql_get_payment_method);

                while ($pm = mysqli_fetch_assoc($payment_method_result)) {
                    echo "<option value='" . $pm['payment_method_id'] . "'>" . $pm['payment_method_desc'] . "</option>";
                }
                ?>
            </select>

            <div id="gcash-details" style="display: none;">
                <label for="f_gcash_ref_num">GCash Reference Number:</label>
                <input type="text" class="form-control mb-3" name="f_gcash_ref_num" id="f_gcash_ref_num">
                <label for="f_gcash_acc_name">GCash Account Name:</label>
                <input type="text" class="form-control mb-3" name="f_gcash_acc_name" id="f_gcash_acc_name">
                <label for="f_gcash_acc_num">GCash Account Number:</label>
                <input type="text" class="form-control mb-3" name="f_gcash_acc_num" id="f_gcash_acc_num">
                <label for="f_gcash_amt_sent">GCash Amount Sent:</label>
                <input type="text" class="form-control mb-3" name="f_gcash_amt_sent" id="f_gcash_amt_sent">
            </div>

            <label for="f_ship_option">Shipping Options:</label>
            <select name="f_ship_option" id="f_ship_option" class="form-select mb-2">
                <?php
                $sql_get_shipping_method = "SELECT * FROM shippers";
                $shipping_method_result = mysqli_query($conn, $sql_get_shipping_method);

                while ($sm = mysqli_fetch_assoc($shipping_method_result)) {
                    echo "<option value='" . $sm['shipper_id'] . "'>" . $sm['shipping_company'] . "</option>";
                }
                ?>
            </select>
            <input type="hidden" name="f_order_ref_number" value="<?php echo $order_number; ?>">

            <?php foreach ($cartItems as $item) { ?>
                <input type="hidden" name="product_id[]" value="<?php echo $item['product_id']; ?>">
                <input type="hidden" name="quantities[]" value="<?php echo $item['quantity']; ?>">
                <input type="hidden" name="order_id[]" value="<?php echo $item['order_id']; ?>">
            <?php } ?>

            <input type="submit" value="Place Order" class="btn btn-warning">
        </div>
    </form>
</div>

<script>
    document.getElementById('f_payment_method').addEventListener('change', function() {
        if (this.value == 'gcash') {
            document.getElementById('gcash-details').style.display = 'block';
        } else {
            document.getElementById('gcash-details').style.display = 'none';
        }
    });
</script>
</body>
</html>
