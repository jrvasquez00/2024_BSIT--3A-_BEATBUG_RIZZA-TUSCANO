<?php

include ('../connection/connection.php');
include ('../myfunctions.php');

if (isset($_POST['add_category_btn'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = isset($_POST['product_status']) ? '0':'1';

    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    $cate_query = "INSERT INTO product_cat 
    (product_cat_name, product_cat_desc, product_status, product_cat_image)
    VALUES ('$name','$description', '$status', '$filename')";

    $cate_query_run = mysqli_query($conn, $cate_query);

    if ($cate_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        redirect("add-cat.php", "Category added successfully");
    } else {
        redirect("add-cat.php", "Something went wrong :(");
    }
 }
 else if (isset($_POST['update_category_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = isset($_POST['product_status']) ? '0':'1';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
       // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $path = "../uploads";
    $update_query = "UPDATE product_cat SET product_cat_name='$name', product_cat_desc='$description',
    product_status='$status', product_cat_image='$update_filename'
     WHERE product_cat_id='$category_id' ";

    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("edit-cat.php?id=$category_id", "Category updated successfully");
    } else {
        redirect("edit-cat.php?id=$category_id", "Something went wrong");

    }
 }
 else if(isset($_POST['delete_cat_btn'])) {
        $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

        $category_query = "SELECT * FROM product_cat WHERE product_cat_id ='$category_id' ";
        $category_query_run =mysqli_query($conn, $category_query);
        $category_data = mysqli_fetch_array($category_query_run);
        $image = $category_data['product_cat_image'];

        $delete_query = "DELETE FROM product_cat WHERE product_cat_id ='$category_id' ";
        $delete_query_run = mysqli_query($conn, $delete_query);

        if($delete_query_run){

            if (file_exists("../uploads/".$image)) {
                unlink("../uploads/".$image);
                }
                // redirect("category.php", "Category deleted successfully");
                echo 200;
            }
            else{
               // redirect("category.php", "Something went wrong :(" );
               echo 500;
            }
 }
 else if(isset($_POST['add_product_btn'])) {
    $category_id = $_POST['product_cat_id'];

    $name = $_POST['product_name'];
    $description = $_POST['product_desc'];
    $product_price = $_POST['product_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $product_status = isset($_POST['product_status']) ? '0':'1';
    $trending = isset($_POST['trending']) ? '0':'1';

    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

        $product_query = "INSERT INTO products (product_id, product_name, product_desc, 
        product_price, selling_price, qty, product_status, trending, product_image)
        VALUES ('$category_id','$name','$description','$product_price',
        '$selling_price','$qty','$product_status','$trending','$filename')";

        $product_query_run = mysqli_query($conn, $product_query);

        if($product_query_run)
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path. '/' .$filename);
            redirect("add-products.php", "Product added successfully");
        }
        else{
            redirect("add-products.php", "Something went wrong :(");
        }
 }
 else if(isset($_POST['update_product_btn'])) {
    $id = $_POST['id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['product_name'];
    $description = $_POST['product_desc'];
    $product_price = $_POST['product_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $product_status = isset($_POST['product_status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $path = "../uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    // Debugging: Escape all input values
    $id = mysqli_real_escape_string($conn, $id);
    $category_id = mysqli_real_escape_string($conn, $category_id);
    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $description);
    $product_price = mysqli_real_escape_string($conn, $product_price);
    $selling_price = mysqli_real_escape_string($conn, $selling_price);
    $qty = mysqli_real_escape_string($conn, $qty);

    $product_status = mysqli_real_escape_string($conn, $product_status);
    $trending = mysqli_real_escape_string($conn, $trending);
    $update_filename = mysqli_real_escape_string($conn, $update_filename);

    // Debugging: Print the query
    $update_product_query = "UPDATE products SET  
        product_name='$name', 
        product_desc='$description', 
        product_price='$product_price', 
        selling_price='$selling_price', 
        qty='$qty', 
        product_status='$product_status',
        trending='$trending', 
        product_image='$update_filename' 
        WHERE product_id='$id'";

    // Print the query to debug syntax issues
    echo $update_product_query;

    $update_product_query_run = mysqli_query($conn, $update_product_query);

    if ($update_product_query_run) {
        // If a new image is uploaded, move it to the uploads directory
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            
            // Delete the old image if it exists
            if (file_exists($path . '/' . $old_image)) {
                unlink($path . '/' . $old_image);
            }
        }
        redirect("edit-product.php?id=$id", "Product updated successfully");
    } else {
        redirect("edit-product.php?id=$id", "Something went wrong");

    }
 }
