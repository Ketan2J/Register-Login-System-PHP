<?php

require '../../include/connection.php';
session_start();

$get_userID = $_SESSION['id'];

$uName = $_GET['uName'];
$uEmail = $_GET['uEmail'];
$uMobileNo = $_GET['mobileNumber'];
$uAddress = $_GET['uCity'];

$update_user = "UPDATE register SET username='{$uName}', mobileno={$uMobileNo}, email='{$uEmail}', city='{$uAddress}' WHERE id='{$get_userID}'";
$run_u = mysqli_query($conn, $update_user);

if ($run_u) {
    header("Location: ../user_edit.php");
} else {
    echo "Failed!!!";
}

?>
