<?php
session_start();
include_once('../connection/connection.php');

if (!isset($_SESSION['customer_id'])) {
    die("Error: User is not logged in.");
}

$conn = connection();

function gen_order_ref_number($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $ref_number = '';
    for ($i = 0; $i < $length; $i++) {
        $ref_number .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $ref_number;
}

if (isset($_POST['delete'])) {
    $order_id = $_POST['delete'];
    $sql_delete_item = "DELETE FROM orders WHERE order_id = '$order_id' AND customer_id = '{$_SESSION['customer_id']}'";
    if (!mysqli_query($conn, $sql_delete_item)) {
        die("Error deleting item from cart: " . mysqli_error($conn));
    }
    header("Location: cart.php");
    exit();
}

// Handle update quantity action
if (isset($_POST['update'])) {
    $order_id = $_POST['update'];
    $new_qty = $_POST['qty'][$order_id];
    $sql_update_quantity = "UPDATE orders SET qty = '$new_qty' WHERE order_id = '$order_id' AND customer_id = '{$_SESSION['customer_id']}'";
    if (!mysqli_query($conn, $sql_update_quantity)) {
        die("Error updating item quantity: " . mysqli_error($conn));
    }
    header("Location: cart.php");
    exit();
}

// Handle checkout action
if (isset($_POST['checkout'])) {
    if (isset($_POST['selected_products']) && !empty($_POST['selected_products'])) {
        $selected_products = $_POST['selected_products'];
        $order_ids = implode(',', $selected_products);

        // Simulate checkout process for selected products
        $checkout_success = true; // Change this to false to simulate a checkout failure

        if ($checkout_success) {
            header("Location: checkout.php?order_ids=" . $order_ids);
            exit();
        } else {
            // Redirect back to cart with an error message
            header("Location: cart.php?error=checkout_failed");
            exit();
        }
    } else {
        // Redirect back to cart with an error message
        header("Location: cart.php?error=no_items_selected");
        exit();
    }
}

$sql_get_cart_items = "SELECT i.product_name, i.product_price, i.product_desc, i.product_image, i.product_cat_id, o.qty, o.order_date, o.order_id
                       FROM `orders` as o
                       JOIN `products` as i ON (o.product_id = i.product_id)
                       WHERE o.customer_id='{$_SESSION['customer_id']}' 
                       AND o.order_phase='1'";

$cart_results = mysqli_query($conn, $sql_get_cart_items);
if (!$cart_results) {
    die("Error fetching cart items: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 0.3;
            }

        .container {
            max-width: 1160px;
            margin: 20px auto;
            padding: 0 20px;
            }

        h1 {
            color: #fff;
            padding: 10px 0;
            text-align: center;
            }

        h1:hover{
            transform: translateX(-5px); 
            transition: transform 0.2s ease; 
        }

        .cart-items {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

        h2 {
            margin-bottom: 20px;
            }

        table {
            width: 100%;
            border-collapse: collapse;
            }

        th, td {
            padding: 12px 15px;
            text-align: left;
            }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        img:hover{
            transform: translateX(-5px); 
            transition: transform 0.2s ease; 
        }

        button  {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 18px;
            border-radius: 5px;
            cursor: pointer;
            }

        button[type="submit"] {
            background-color: #28a745;
        } 

        button[type="submit"]:hover {
            background-color: #218838;
        }

        p {
            margin-bottom: 20px;
            font-style: italic;
        }

        p.error {
            color: red;
        }

        .checkout-container {
        text-align: right;
        margin-top: 20px; 
        padding-right: 30px
        } 

        .top{
            position: fixed;
            bottom: 2.1rem;
            right: 1.0rem;
        }
        .top i {
            color: #000;
            background: #fdd1bdf1; 
            font-size: 14px;
            padding: 10px;
            border-radius: 5px;
        }

        .back-button {
            background-color: transparent; 
            color: #fff; 
            top:10px;  
            position: fixed;
            font-size: 16px; 
            padding-left: 1px  
   
        }

        #search form {
            display: flex;
            align-items: center;
            margin-left: 900px;
        }

        #search input[type="text"] {
            width: 170px; 
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            padding: 5px 10px;
        }

        #search button {
            padding: 5px 10px;
            background-color: #0bff9a;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #search button:hover {
            background-color: #a0ffb5;
        }
        </style>

</head>
<body>
    <header>
           <h1>Shopping Cart</h1>
           <nav>
            <ul>
                <li><a href="client.php">Home</a></li>
                <li><a href="our products.php">See Our Products</a></li>
                <li><a href="../index.php">Logout</a></li>
                <li><a href="order.php">My Orders</a></li>
                <li class="cart">
                    <a href="cart.php">
                        <img src="../img/shopping-cart.png" alt="Shopping Cart">
                    </a>
                </li>
                <section id="search">
                        <form action="search results.php" method="get">
                            <input type="text" name="query" placeholder="Search for products..." required>
                            <button type="submit">Search</button>
                        </form>
                    </section>
                    </section>
                </li>
            </ul>
        </nav>
     
    </header>

    <div class="container">
        <div class="cart-items">
            <h2>Cart Items</h2>
            <?php if (mysqli_num_rows($cart_results) > 0) { ?>
                <form method="POST" action="cart.php">
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                            <th>Select</th>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($cart_results)) { ?>
                            <tr>
                                <td><?php echo $row['product_name']; ?></td>
                                <td>
                                    <img src="../uploads/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>" style="width:100px;height:80px;">
                                </td>
                                <td><?php echo $row['product_price']; ?></td>
                                <td>
                                    <input type="number" name="qty[<?php echo $row['order_id']; ?>]" value="<?php echo $row['qty']; ?>" min="1" style="width:70px;height:20px;">
                                </td>
                                <td>
                                    <button type="submit" name="update" value="<?php echo $row['order_id']; ?>">Update</button>
                                    <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this item?');" value="<?php echo $row['order_id']; ?>">Delete</button>
                                </td>
                                <td>
                                    <input type="checkbox" name="selected_products[]" value="<?php echo $row['order_id']; ?>">
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <div class="checkout-container">
                        <button type="submit" name="checkout">Checkout Selected</button>
                    </div>
                </form>
                <?php if (isset($_GET['error']) && $_GET['error'] == 'checkout_failed') { ?>
                    <p style="color: red;">Checkout failed. Please try again.</p>
                <?php } elseif (isset($_GET['error']) && $_GET['error'] == 'no_items_selected') { ?>
                    <p style="color: red;">No items selected for checkout.</p>
                <?php } ?>
            <?php } else { ?>
                <p>Your cart is empty.</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
