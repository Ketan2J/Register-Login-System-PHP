<?php

require '../../include/connection.php';

$username = $_GET['uname'];
$mobileNo = $_GET['mobile_no'];
$email = $_GET['email_address'];
$pwd = $_GET['password'];
$address = $_GET['city'];
$userRole = $_GET['user_Role'];

$insert = "INSERT INTO register (username, mobileno, email, password, city, user_role) VALUES ('$username', '$mobileNo', '$email', '$pwd', '$address', '$userRole')";
$query_run = mysqli_query($conn, $insert);

if ($query_run) {
    $a = json_encode(array('status' => '200'));
    if ($a) {
        header("Location: ../login.php");
    }
}

?>
