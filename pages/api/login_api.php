<?php

require '../../include/connection.php';
session_start();

$user_email = $_GET['email_address'];
$user_pass = $_GET['pass'];

$select_query = "SELECT * FROM register WHERE email='{$user_email}'";
$query = mysqli_query($conn, $select_query);
$col_num = mysqli_num_rows($query);

if ($col_num > 0) {
    $result = mysqli_fetch_array($query);
    $_SESSION['id'] = $result['id'];
    $_SESSION['email'] = $result['email'];

    $response = json_encode(array('status' => '200'));
    echo json_encode($result);
    header("Location: ../login.php");

    // $hash_pwd = password_hash($user_pass, PASSWORD_DEFAULT);

    // if (password_verify($user_pass, $hash_pwd)) {
    //     if ($result['user_role'] == 'admin') {
    //         echo json_encode($result);
    //     } else if ($result['user_role'] == 'user') {
    //         echo json_encode($result);
    //     }
    // }
}

?>
