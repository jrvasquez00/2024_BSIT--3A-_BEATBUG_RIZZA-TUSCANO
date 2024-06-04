<?php
session_start();
include_once('../connection/connection.php');

// Establish connection
$conn = connection();

function getAll($table){
    global $conn;
    $query = "SELECT * FROM $table";
    $query_run = mysqli_query($conn, $query);
    if(!$query_run) {
        die("Query Failed: " . mysqli_error($conn));
    }
    return $query_run;
}

function getByID($table, $id){
    global $conn;
    $query = "SELECT * FROM $table WHERE product_id='$id' ";
    $query_run = mysqli_query($conn, $query);
    if(!$query_run) {
        die("Query Failed: " . mysqli_error($conn));
    }
    return $query_run;
}

function getByIDcat($table, $id){
    global $conn;
    $query = "SELECT * FROM $table WHERE product_cat_id='$id' ";
    $query_run = mysqli_query($conn, $query);
    if(!$query_run) {
        die("Query Failed: " . mysqli_error($conn));
    }
    return $query_run;
}
function getProductsByCategory($category_id){
    global $conn;
    $query = "SELECT * FROM products WHERE product_cat_id='$category_id'";
    $query_run = mysqli_query($conn, $query);
    if(!$query_run) {
        die("Query Failed: " . mysqli_error($conn));
    }
    return $query_run;
}


function getAllActive($table){
    global $conn;
    $query = "SELECT * FROM $table WHERE product_status ='1'";
    $query_run = mysqli_query($conn, $query);
    if(!$query_run) {
        die("Query Failed: " . mysqli_error($conn));
    }
    return $query_run;
}

function getAllTrending($table){
    global $conn;
    $query = "SELECT * FROM $table WHERE trending ='1'";
    $query_run = mysqli_query($conn, $query);
    if(!$query_run) {
        die("Query Failed: " . mysqli_error($conn));
    }
    return $query_run;
}

function redirect($url, $message){
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}
?>
