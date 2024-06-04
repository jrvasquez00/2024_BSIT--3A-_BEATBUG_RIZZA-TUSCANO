
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Place Order</title>
    <link rel="stylesheet" href="../css/bootstrap.css">

        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        /* .container {
            width: 100px;
            margin: 0 auto;
            padding: 20px;
        } */

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            padding: 20px;
            /* width: 1000px;
            margin: 0 auto; */
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin-left: 1050px;
        }

        .btn-primary:hover {
            background-color: #218838;
        }

        .card hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }

        .card b {
            color: #007bff;
        }
        
        .q {
            background-color: #c1f4c6;
            color: black;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #2c9437;
            border-radius: 5px;
        }
       </style>

</head>
<body>



<?php
session_start();
include_once('../connection/connection.php');

$conn = connection();

if (isset($_POST['f_payment_method'])) {
    $payment_method = $_POST['f_payment_method'];
    $order_ref_number = $_POST['f_order_ref_number'];
    $customer_id = $_SESSION['customer_id'];
    $alt_receiver = $_POST['f_alt_receiver'];
    $alt_address = $_POST['f_alt_address'];
    $shipper_id = $_POST['f_ship_option'];
    $total_amt_to_pay = $_POST['f_total_amt_to_pay'];
    $product_ids = $_POST['product_id']; // Array of product IDs
    $quantities = $_POST['quantities']; // Array of quantities
    $order_ids = $_POST['order_id']; // Array of order IDs

    if ($payment_method == "1") {
        // Gcash payment method handling
        ?>
        <div class="card p-2">
            <div class="q">
                <h3 class="display-3">Input Gcash Payment Details</h3>
                <form action="payment.php" method="POST">
                    Total Amount to Pay: <b><?php echo "Php " . number_format($total_amt_to_pay, 2); ?></b><br>
                    Please pay EXACT AMOUNT to this Gcash Account Number: 09887766554<br>
                    Account Name: BibimMart Store
                </div>
                <hr>
                <input type="hidden" name="f_total_amt_to_pay" value="<?php echo $total_amt_to_pay; ?>" />
                <input type="hidden" name="f_payment_method" value="<?php echo $payment_method; ?>" />
                <input type="hidden" name="f_order_ref_number" value="<?php echo $order_ref_number; ?>" />
                <input type="hidden" name="f_alt_receiver" value="<?php echo $alt_receiver; ?>" />
                <input type="hidden" name="f_alt_address" value="<?php echo $alt_address; ?>" />
                <input type="hidden" name="f_shipper_option" value="<?php echo $shipper_id; ?>" />
                
                <?php foreach ($product_ids as $index => $product_id) { ?>
                    <input type="hidden" name="product_id[]" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="quantities[]" value="<?php echo $quantities[$index]; ?>">
                    <input type="hidden" name="order_id[]" value="<?php echo $order_ids[$index]; ?>">
                <?php } ?>

                <label for="f_gcash_ref_num">GCash Reference Number:</label>
                <input type="text" name="f_gcash_ref_num" id="f_gcash_ref_num" class="form-control">
                <label for="f_gcash_acc_name">GCash Account Name:</label>
                <input type="text" name="f_gcash_acc_name" id="f_gcash_acc_name" class="form-control">
                <label for="f_gcash_acc_num">GCash Account Number:</label>
                <input type="text" name="f_gcash_acc_num" id="f_gcash_acc_num" class="form-control">
                <label for="f_gcash_amt_sent">Amount Sent:</label>
                <input type="number" step="0.01" name="f_gcash_amt_sent" id="f_gcash_amt_sent" class="form-control">
                <input type="submit" value="Submit Payment" class="btn btn-primary">
            </form>
        </div>
        <?php
    } else {
        // Non-Gcash payment method handling
        $sql_update_order = "UPDATE `orders`
                             SET `order_phase` = 2,
                                 `order_ref_number` = '$order_ref_number',
                                 `payment_method` = '$payment_method',
                                 `secondary_receiver` = '$alt_receiver',
                                 `secondary_address` = '$alt_address',
                                 `shipper_id` = '$shipper_id',
                                 `total_amt_to_pay` = '$total_amt_to_pay'
                             WHERE `customer_id` = '$customer_id'
                               AND `order_phase` = 1
                               AND `order_id` IN (" . implode(',', array_map('intval', $order_ids)) . ")";
        
        $execute_update_order = mysqli_query($conn, $sql_update_order);

        if ($execute_update_order) {
            header("location: order.php?page=home&msg=1");
        } else {
            header("location: client.php?page=home&msg=2");
        }
    }
}
?>
