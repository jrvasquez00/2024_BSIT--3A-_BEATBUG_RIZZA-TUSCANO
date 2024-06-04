<?php
include_once('../connection/connection.php');
session_start();

$conn = connection();

if (isset($_POST['f_order_ref_number'])) {
    $ord_ref_num = $_POST['f_order_ref_number'];
    $customer_id = $_SESSION['customer_id'];
    $alt_rec = $_POST['f_alt_receiver'];
    $alt_add = $_POST['f_alt_address'];
    $shipper_id = $_POST['f_shipper_option'];
    $payment_method = $_POST['f_payment_method'];
    $gcash_ref_num = $_POST['f_gcash_ref_num'];
    $gcash_acc_name = $_POST['f_gcash_acc_name'];
    $gcash_acc_num = $_POST['f_gcash_acc_num'];
    $gcash_amt_sent = $_POST['f_gcash_amt_sent'];
    $total_amt_to_pay = $_POST['f_total_amt_to_pay'];
    $order_ids = $_POST['order_id']; // Array of order IDs

    if ($total_amt_to_pay > $gcash_amt_sent) {
        header("location: index.php?page=home&msg=Amount is Insufficient.");
        die();
    }

    $sql_update_order = "UPDATE `orders`
                         SET `order_phase` = 2,
                             `order_ref_number` = '$ord_ref_num',
                             `payment_method` = '$payment_method',
                             `secondary_receiver` = '$alt_rec',
                             `secondary_address` = '$alt_add',
                             `shipper_id` = '$shipper_id',
                             `gcash_ref_num` = '$gcash_ref_num',
                             `gcash_acc_name` = '$gcash_acc_name',
                             `gcash_acc_num` = '$gcash_acc_num',
                             `gcash_amt_sent` = '$gcash_amt_sent',
                             `total_amt_to_pay` = '$total_amt_to_pay'
                         WHERE `customer_id` = '$customer_id' 
                           AND `order_phase` = '1'
                           AND `order_id` IN (" . implode(',', array_map('intval', $order_ids)) . ")";
    
    $execute_update_order = mysqli_query($conn, $sql_update_order);

    if ($execute_update_order) {
        header("location: order.php?page=home&msg=1");
    } else {
        header("location: client.php?page=home&msg=2");
    }
}
?>
