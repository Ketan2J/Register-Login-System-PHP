<?php

require '../include/connection.php';
session_start();

$curr_user_id = $_SESSION['id'];

$friend_id = $_GET['friend_id'];

$get_current_user_id = "SELECT * FROM register WHERE id='{$curr_user_id}'";
$run_query = mysqli_query($conn, $get_current_user_id);
if ($run_query) {
    $row = mysqli_fetch_array($run_query);
    $new_f_request = $row['f_request'].$friend_id.',';

    $update_q = "UPDATE register SET f_request='$new_f_request' WHERE id='$curr_user_id'";
    $run_update = mysqli_query($conn, $update_q);
    if ($run_update) {
        header("Location: ./user_profile.php");
    }
}

?>
