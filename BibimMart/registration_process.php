<?php
include_once "connection/connection.php";

// Establish database connection
$conn = connection();

if (!$conn) {
    // Database connection failed
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['r_username'];
$email = $_POST['r_email'];
$firstname = $_POST['r_firstname'];
$lastname = $_POST['r_lastname'];
$age = $_POST['r_age'];
$address = $_POST['r_address'];
$contact = $_POST['r_contact_number'];
$password = $_POST['r_passwrd'];
$conf_passwd = $_POST['r_conf_passwrd'];
$user = $_POST['r_user_type'];

function chk_pass($p1, $p2) {
    return ($p1 == $p2) ? 1 : 0;
}

if (!chk_pass($password, $conf_passwd)) {
    header("location: registration.php?error=password_mismatch");
    die;
}

$sql_chk_user = "SELECT customer_id FROM users WHERE `username` = '$username'";
$sql_result = mysqli_query($conn, $sql_chk_user);

if (!$sql_result) {
    die("Error: " . mysqli_error($conn)); // Check for SQL query error
}

$count_result = mysqli_num_rows($sql_result);

if ($count_result > 0) {
    header("location: registration.php?error=user_already_exist");
} else {
    $sql_new_user = "INSERT INTO `users` 
                    (`username`, `email`, `firstname`, `lastname`, `age`, `address`, `contact_number`, `password`, `user_type`)
                    VALUES
                    ('$username', '$email', '$firstname', '$lastname', '$age', '$address', '$contact', '$password', '$user')";
    $execute_query = mysqli_query($conn, $sql_new_user);

    if (!$execute_query) {
        die("Error: " . mysqli_error($conn)); // Check for insert query error
    } else {
        header("location: index.php?msg=successfully_registered");
    }
}
?>
