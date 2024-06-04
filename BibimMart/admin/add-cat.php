<?php 
include('../middleware/adminMiddleware.php');
include ('includes/header.php');

?>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Category
                    <a href="category.php" class="btn btn-primary float-end"> <i class="material-icons">arrow_back</i> Back</a>
                    </h4> 
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="mb-0">Name</label>
                            <input type="text" name="name" placeholder="Enter category name" class="form-control mb-2"></input>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0">Description</label>
                            <textarea rows="2" name="description" placeholder="Enter category description"
                                class="form-control mb-2"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0">Upload Image</label>
                            <input type="file" name="image" class="form-control mb-2">
                        </div>

                        <div class="col-md-3">
                                        <label class="mb-0">Status :</label>
                                        <input type="checkbox"  name="status"></input>
                        </div>

                        <div class="col-md-12">
                                    <label>   </label>
                                </div>
                        <div class="col-md-12 ">
                            <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                        </div>
                    </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>


<?php include ('includes/footer.php'); ?>