<?php
if(isset($_POST['f_product_name'])) { 
    include_once("../connection/connection.php");
    
    // Check if the file has been uploaded
    if(isset($_FILES["f_product_img"])) {
        $target_dir = "../img/";
        $target_file = $target_dir . basename($_FILES["f_product_img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["f_product_img"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["f_product_img"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            header("location: index.php?insert_status=99");
        } else {
            if (move_uploaded_file($_FILES["f_product_img"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["f_product_img"]["name"])). " has been uploaded.";
            } else {
                header("location: index.php?insert_status=99");
            }
        }
    }
    
    // Get other form data
    $db_filename = basename($_FILES["f_product_img"]["name"]);
    $product_name = mysqli_real_escape_string($conn, $_POST['f_product_name']);
    $product_desc = mysqli_real_escape_string($conn, $_POST['f_product_desc']);
    $Price = mysqli_real_escape_string($conn, $_POST['f_product_price']);
    
    // Insert into database
    $sql_insert_item = "INSERT INTO `products` (`product_name`, `product_desc`, `product_price`, `product_img`)
                        VALUES ('$product_name','$product_desc','$product_price','$db_filename')";

    $execute_query = mysqli_query($conn, $sql_insert_item);
    
    if($execute_query) {
        header("location: ../client.php?insert_status=1");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("location: ../index.php?you_cant_be_here");
}
?>
