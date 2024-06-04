<?php
include ('../middleware/adminMiddleware.php');
include ('includes/header.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Orders</title>
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
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }

    </style>
</head>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $product = getByID("products", $id);
                if (mysqli_num_rows($product) > 0) {
                    $data = mysqli_fetch_array($product)
                        ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Product
                                <a href="products.php" class="btn btn-primary float-end"><i class="material-icons">arrow_back</i> Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="mb-0">Category</label>
                                        <select name="category_id" class="form-select mb-2">
                                            <option selected>Select Category</option>
                                            <?php
                                            $categories = getAll("product_cat");
                                            if (mysqli_num_rows($categories) > 0) {
                                                foreach ($categories as $item) {
                                                    ?>
                                                    <option value="<?= $item['product_cat_id'];?>" <?=$data['product_cat_id'] == $item['product_cat_id']? 'selected':''?> ><?= $item['product_cat_name']; ?>  </option>
                                                <?php
                                                }
                                            } else {
                                                echo "No categories found";
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value="<?= $data['product_id']; ?>">
                                        <label class="mb-0">Name</label>
                                        <input type="text" required name="product_name" value="<?= $data['product_name']; ?>"
                                            placeholder="Enter product name" class="form-control mb-2"></input>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Description</label>
                                        <textarea rows="2" required name="product_desc" placeholder="Enter products description"
                                            class="form-control mb-2"><?= $data['product_desc'] ?></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="mb-0">Original Price</label>
                                        <input type="text" required name="product_price" value="<?= $data['product_price']; ?>"
                                            placeholder="Enter product price" class="form-control mb-2"></input>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="mb-0">Selling Price</label>
                                        <input type="text" required name="selling_price" value="<?= $data['selling_price']; ?>"
                                            placeholder="Enter selling price" class="form-control mb-2"></input>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="mb-0">Upload Image</label>
                                        <input type="hidden" name="old_image" value="<?= $data['product_image']; ?>">
                                        <input type="file" name="image" class="form-control mb-2">
                                        <label class="mb-0">Current Image: </label>
                                        <img src="../uploads/<?= $data['product_image']; ?>" alt="Product image" height="50px"
                                            width="50px">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="mb-0">Product Quantity</label>
                                            <input type="number" required name="qty" value="<?= $data['qty']; ?>"
                                                placeholder="Enter product quantity" class="form-control mb-2"></input>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="mb-0">Status :</label> <br>
                                            <input type="checkbox" name="product_status"
                                                <?= $data['product_status'] == '0' ? '' : 'checked' ?>> </input>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0">Popular :</label> <br>
                                            <input type="checkbox" name="trending" <?= $data['trending'] == '0' ? '' : 'checked' ?>>
                                            </input>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label> </label>
                                    </div>
                                    <div class="col-md-12 ">
                                        <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                } else {
                    echo "Product not found in the given id";
                }

            } else {
                echo "Id missing from url";
            }
            ?>
        </div>
    </div>
</div>


<?php include ('includes/footer.php'); ?>