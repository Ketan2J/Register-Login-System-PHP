<?php

require '../include/connection.php';
session_start();

$get_post_id = $_GET['post_id'];

$approved = 'approved';
$disapproved = 'disapproved';

$update_post_status = "UPDATE post SET status='$approved' WHERE id='{$get_post_id}'";
$run_query = mysqli_query($conn, $update_post_status);
if ($run_query) {
    $post_approved_msg = 'Post Approved Successfully';
    header("Location: ../pages/user_records.php?postApproved=$post_approved_msg");
} else {
    echo 'ERR: ';
}

?>