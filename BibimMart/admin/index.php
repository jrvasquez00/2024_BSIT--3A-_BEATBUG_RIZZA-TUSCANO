<?php
include ('../middleware/adminMiddleware.php');
include ('includes/header.php');

// Assuming you have a database connection $conn
// Fetch the total number of categories
$queryCategories = "SELECT COUNT(*) AS totalCategories FROM product_cat";
$resultCategories = mysqli_query($conn, $queryCategories);
$rowCategories = mysqli_fetch_assoc($resultCategories);
$totalCategories = $rowCategories['totalCategories'];

// Fetch the total number of products
$queryProducts = "SELECT COUNT(*) AS totalProducts FROM products";
$resultProducts = mysqli_query($conn, $queryProducts);
$rowProducts = mysqli_fetch_assoc($resultProducts);
$totalProducts = $rowProducts['totalProducts'];

// Fetch the total number of orders
$queryOrders = "SELECT COUNT(*) AS totalOrders FROM orders WHERE order_phase = 2";
$resultOrders = mysqli_query($conn, $queryOrders);
$rowOrders = mysqli_fetch_assoc($resultOrders);
$totalOrders = $rowOrders['totalOrders'];

// Fetch the total number of users where user_type is 'A'
$queryUsers = "SELECT COUNT(*) AS totalUsers FROM users WHERE user_type ='A'";
$resultUsers = mysqli_query($conn, $queryUsers);
$rowUsers = mysqli_fetch_assoc($resultUsers);
$totalUsers = $rowUsers['totalUsers'];

// Fetch the total number of revenue
$queryRevenue = "SELECT SUM(total_amt_to_pay) AS totalRevenue FROM orders";
$resultRevenue = mysqli_query($conn, $queryRevenue);
$rowRevenue = mysqli_fetch_assoc($resultRevenue);
$totalRevenue = $rowRevenue['totalRevenue'];
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row mt-3">
                <div class="col-lg-5 col-sm-5">
                    <!-- Total Revenue Card -->
                    <a href="revenue.php" class="text-decoration-none">
                        <div class="card mb-4">
                            <div class="card-header p-4 pt-3 bg-transparent">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">monetization_on</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Total Revenue:</p>
                                    <h2 class="mb-0"><?php echo $totalRevenue; ?></h2>
                                </div>
                            </div>
                            <hr class="horizontal my-0 dark">
                            <div class="card-footer p-3">
                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                    </span><b>REVENUE</b></p>
                            </div>
                        </div>
                    </a>

                    <!-- Categories Card -->
                    <a href="category.php" class="text-decoration-none">
                        <div class="card mb-4">
                            <div class="card-header p-4 pt-3">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">category</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Total Categories</p>
                                    <h2 class="mb-0"><?php echo $totalCategories; ?></h2>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                    </span><b>CATEGORIES</b></p>
                            </div>
                        </div>
                    </a>

                    <!-- Orders Card -->
                    <a href="orders.php" class="text-decoration-none">
                        <div class="card mb-2">
                            <div class="card-header p-3 pt-2">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">local_mall</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Pending Orders</p>
                                    <h2 class="mb-0"><?php echo $totalOrders; ?></h2>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                    </span><b>ORDERS</b>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-5 col-sm-5 mt-sm-0 mt-4">
                    <!-- Products Card -->
                    <a href="products.php" class="text-decoration-none">
                        <div class="card mb-4">
                            <div class="card-header p-4 pt-3 bg-transparent">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">view_list</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-sm mb-0 text-capitalize">Total Products</p>
                                    <h2 class="mb-0"><?php echo $totalProducts; ?></h2>
                                </div>
                            </div>
                            <hr class="horizontal my-0 dark">
                            <div class="card-footer p-3">
                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                    </span><b>PRODUCTS</b></p>
                            </div>
                        </div>
                    </a>

                    <!-- Users Card -->
                    <div class="card mb-2">
                        <div class="card-header p-4 pt-3 bg-transparent">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-danger shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">account_circle </i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Users</p>
                                <h2 class="mb-0"><?php echo $totalUsers; ?></h2>
                            </div>
                        </div>
                        <hr class="horizontal my-0 dark">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder"> </span><b>USERS</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ('includes/footer.php'); ?>