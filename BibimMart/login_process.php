<?php
include_once "connection/connection.php";
session_start();
$conn = connection();

if (isset($_POST['Username']) && isset($_POST['Password'])) {
    $uname = $_POST['Username'];
    $pword = $_POST['Password'];
    
    $sql_check_user_info = "SELECT * FROM `users` WHERE `username` = '$uname' AND `password` = '$pword'";
    $sql_result = mysqli_query($conn, $sql_check_user_info);
    
    if (!$sql_result) {
        die("Error: " . mysqli_error($conn));
    }
    
    $count_result = mysqli_num_rows($sql_result);
    
    if ($count_result == 1) {
        $row = mysqli_fetch_assoc($sql_result);
        
        $_SESSION['customer_id'] = $row['customer_id'];
        $_SESSION['users_username'] = $row['username'];
        $_SESSION['users_password'] = $row['password'];
        $_SESSION['users_fullname'] = $row['fullname'];
        $_SESSION['users_address'] = $row['address'];
        $_SESSION['users_contact_no'] = $row['contact_no'];
        $_SESSION['users_gender'] = $row['gender'];
        $_SESSION['users_user_type'] = $row['user_type'];
        
        if ($row['user_type'] == 'A') {
            header("Location: admin/index.php");
            exit;
        } else if ($row['user_type'] == 'C') {
            header("Location: client/client.php");
            exit;
        } else {
            header("Location: index.php?error=user_not_found");
            exit;
        }
    } else {
        header("Location: registration.php?error=user_not_exist");
        exit;
    }
}
?>
