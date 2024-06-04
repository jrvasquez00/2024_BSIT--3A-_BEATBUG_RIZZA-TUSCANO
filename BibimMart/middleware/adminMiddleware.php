<?php
include('../myfunctions.php');

if(isset($_SESSION['auth']))
{
    if($_SESSION['user_type'] != 'A'){

        redirect("../index.php", "You are not Authorized to access this page.");
    }
    else{

        redirect("../login.php", "Login to continue");
    }
} 
?>