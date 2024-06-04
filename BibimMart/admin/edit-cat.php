<?php

include ('../middleware/adminMiddleware.php');
include ('includes/header.php');
?>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $category = getByIDcat("product_cat", $id);

                if (mysqli_num_rows($category) > 0) {
                    $data = mysqli_fetch_array($category);
                    ?>
                    <div class="card">
                    <div class="card-header">
                        <h4>Edit Category
                        <a href="category.php" class="btn btn-primary float-end"><i class="material-icons">arrow_back</i> Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="category_id" value="<?=$data['product_cat_id'] ?>">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="<?=$data['product_cat_name'] ?>" placeholder="Enter category name" class="form-control"></input>
                                </div>
                                <div class="col-md-12">
                                    <label for="description">Description</label>
                                    <textarea rows="2" name="description" placeholder="Enter category description"
                                        class="form-control"><?=$data['product_cat_desc']?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="image">Upload Image</label>
                                    <input type="file" name="image" class="form-control">
                                    <label for="image">Current Image</label>
                                    <input type="hidden" name="old_image" value="<?=$data['product_cat_image'] ?>">
                                    <img src="../uploads/<?=$data['product_cat_image']?>" width="50px" height="50px" alt="">
                                </div>

                                <div class="col-md-3">
                                        <label class="mb-0">Status :</label>
                                        <input type="checkbox" <?=$data['product_status'] == '0' ? '' : 'checked' ?> name="status"></input>
                                </div>

                                <div class="col-md-12">
                                    <label>   </label>
                                </div>
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                } else {
                    echo "Category not found";

                }
            } else {
                echo "ID missing from url";
            }
            ?>
        </div>
    </div>
</div>


<?php include ('includes/footer.php'); ?>