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
            <div class="card">
                <div class="card-header">
                    <h4>Categories
                    <a href="add-cat.php" class="btn btn-primary float-end"><i class="material-icons">add</i> Add Category</a>
                    </h4> 
                </div>
                <div class="card-body" id="category_table">
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
                            $category = getAll("product_cat");
                            if (mysqli_num_rows($category) > 0) {
                                foreach ($category as $item) {
                                    ?>
                                    <tr>
                                        <td> <?= $item['product_cat_id']; ?> </td>
                                        <td> <?= $item['product_cat_name']; ?> </td>
                                        <td>
                                            <img src="../uploads/<?= $item['product_cat_image']; ?>" width="50px" height="50px"
                                                alt="<?= $item['product_cat_image']; ?>">
                                        </td>
                                        <td> <?= $item['product_status'] == '1'? "Visible":"Hidden"; ?> </td>
                                        <td>
                                            <a href="edit-cat.php?id=<?= $item['product_cat_id']; ?>" class="btn btn-primary"
                                                style="display: inline-block;">Edit</a>
                                            <!-- <form action="code.php" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                <button type="submit" class="btn btn-danger"
                                                    name="delete_cat_btn">Delete</button>
                                            </form> -->
                                            <button type="button" class="btn btn-danger delete_cat_btn" value="<?=$item['product_cat_id']; ?>" >Delete</button>
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
        </div>
    </div>
</div>

<?php include ('includes/footer.php'); ?>