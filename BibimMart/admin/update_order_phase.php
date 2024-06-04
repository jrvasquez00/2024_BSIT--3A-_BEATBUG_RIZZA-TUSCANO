<?php
// Establishing database connection
include('../middleware/adminMiddleware.php');

$conn = connection();

// Check if order_id and status parameters are set
if (isset($_GET['order_id']) && isset($_GET['status'])) {
    // Sanitize input
    $order_id = mysqli_real_escape_string($conn, $_GET['order_id']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);

    // Debug output
    echo "Order ID: " . $order_id . "<br>";
    echo "Status: " . $status . "<br>";

    // Update the status in the database
    $update_sql = "UPDATE orders SET order_phase = '$status' WHERE order_id = '$order_id'";
    $update_result = mysqli_query($conn, $update_sql);

    if ($update_result) {
        // Redirect back to the orders page
        header("Location: orders.php");
        exit();
    } else {
        // Handle the error
        echo "Error updating status: " . mysqli_error($conn);
    }
} else {
    // Redirect back to the orders page if parameters are not set
    header("Location: orders.php");
    exit();
}
?>
