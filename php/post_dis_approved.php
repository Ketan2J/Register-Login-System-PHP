<?php

require '../include/connection.php';
session_start();

$get_post_id = $_GET['post_id'];

$disapproved = 'disapproved';

$update_post_status = "UPDATE post SET status='$disapproved' WHERE id='{$get_post_id}'";
$run_query = mysqli_query($conn, $update_post_status);
if ($run_query) {
    $post_dis_approved_msg = 'Post Disapproved Successfully';
    header("Location: ../pages/user_records.php?postDisapproved=$post_dis_approved_msg");
} else {
    echo 'ERR: ';
}

?>