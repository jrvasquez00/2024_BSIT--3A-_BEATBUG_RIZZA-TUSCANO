<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php');
function deleteProduct($productId) {
    require_once('../connection/connection.php'); 
  
    $conn = connection();
  
    $sql = "DELETE FROM products WHERE product_id = ?"; 
  
    $stmt = mysqli_prepare($conn, $sql); 
  
    mysqli_stmt_bind_param($stmt, "i", $productId); 
  
    if (mysqli_stmt_execute($stmt)) {
      echo "<script>alert('Product deleted successfully!'); window.location.reload();</script>"; // Reload page after successful delete
    } else {
      echo "<script>alert('Error deleting product: " . mysqli_error($conn) . "');</script>";
    }
  
    mysqli_stmt_close($stmt); 
    mysqli_close($conn); 
  }
  
  if (isset($_POST['delete'])) {
    $product_id = $_POST['delete'];
    deleteProduct($product_id); 
    exit(); 
  }
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
        .red-button {
          color: white; /* Text color */
    background-color: red; /* Background color */
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
            <div class="card">
                <div class="card-header">
                    <h4>Products
                    <a href="add-products.php" class="btn btn-primary float-end"><i class="material-icons">add</i> Add Product</a>
                    </h4>
                </div>
                <div class="card-body" id="products_table">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Image</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $products = getAll("products");
        if (mysqli_num_rows($products) > 0) {
          foreach ($products as $item) {
            ?>
            <tr>
              <td><?= $item['product_id']; ?></td>
              <td><?= $item['product_name']; ?></td>
              <td>
                <img src="../uploads/<?=$item['product_image']; ?>" width="50px" height="50px" alt="<?= $item['product_image']; ?>">
              </td>
              <td>
                <?= $item['product_status'] == '1' ? "Visible" : "Hidden"; ?>
              </td>
              <td>
                <a href="edit-product.php?id=<?= $item['product_id']; ?>" class="btn btn-primary" style="display: inline-block;">Edit</a>
                <form action="" method="post" style="display: inline-block;">
    <button type="submit" name="delete" value="<?= $item['product_id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="red-button">Delete</button>
</form>

                </form>
              </td>
            </tr>
            <?php
          }
        } else {
          echo "No records found";
        }
        ?>
      </tbody>
    </table>
  </div>
  </div>

<?php include ('includes/footer.php'); ?>