<?php

require_once '../include/connection.php';

$userName = $_POST['uname']; 
$mobileNumber = $_POST['mobile_no'];
$emailAddress = $_POST['email_address'];
$password = $_POST['password'];
$city = $_POST['city'];
$userRole = $_POST['user_Role'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$insert_query = "INSERT INTO register( username, mobileno, email, password, city, user_role) VALUES( '$userName', '$mobileNumber', '$emailAddress', '$hashed_password', '$city', '$userRole')";

if (mysqli_query($conn, $insert_query)) {
    header('Location: ../pages/login.php');
} else {
    echo "Insert operation failed!";
}

?>
