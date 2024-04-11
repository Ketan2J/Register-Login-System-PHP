<?php

require '../../include/connection.php';
session_start();

$get_user_id = $_SESSION['id'];

$select_user = "SELECT * FROM register WHERE id='$get_user_id'";
$run_users = mysqli_query($conn, $select_user);
$get_user_info_array = mysqli_fetch_array($run_users);

$new_user_arr = array(
    'user_name' => $get_user_info_array['username'],
    'user_email' => $get_user_info_array['email'],
    'user_mobile_no' => $get_user_info_array['mobileno'],
    'user_city' => $get_user_info_array['city'],
);
echo json_encode($new_user_arr);

?>
