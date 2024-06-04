<?php
session_start();
include_once('../connection/connection.php');

$conn = connection();

if(isset($_GET['product_id'])){
    $customer_id = $_SESSION['customer_id'];
    $product_id = $_GET['product_id'];
    $qty = 1; // Assuming default quantity is 1, you can change this as needed

    // Fetch product_cat_id from the products table
    $sql_get_cat_id = "SELECT product_cat_id FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $sql_get_cat_id);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $product_cat_id = $row['product_cat_id'];

        $sql_add_to_cart = "INSERT INTO `orders` (`customer_id`, `product_id`, `product_cat_id`, `qty`)
                            VALUES ('$customer_id', '$product_id', '$product_cat_id', '$qty')";
        $execute_cart = mysqli_query($conn, $sql_add_to_cart);
        
        if($execute_cart){
            header("location: our products.php?page=home&cart_status=item_{$product_id}_added_to_cart");
        } else {
            echo "Error adding item to cart: " . mysqli_error($conn);
        }
    } else {
        echo "Error fetching product category ID: " . mysqli_error($conn);
    }
}
?>
