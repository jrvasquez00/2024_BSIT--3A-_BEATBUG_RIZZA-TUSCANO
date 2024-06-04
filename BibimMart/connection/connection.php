<?php

function connection(){
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbName = "bibimmart";

    // Establish connection
    $conn = mysqli_connect($host, $username, $password, $dbName);

    // Check connection
    if (!$conn) {
        echo "Failed to connect: " . mysqli_connect_error();
        exit;
    }

    return $conn; // Return the connection object
}
