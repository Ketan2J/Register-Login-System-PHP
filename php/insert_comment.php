<?php

require '../include/connection.php';
session_start();

$user_id = $_SESSION['id'];
$user_c = $_POST['newcomment'];
$user_post_id = $_POST['post-id'];
echo $user_post_id;
$curr_date = date('Y-m-d H:i:s');

$insert_comm = "INSERT INTO comment ( post_id, user_id, comment, date_t) VALUES ('{$user_post_id}', '{$user_id}', '{$user_c}', '{$curr_date}')";
$run_query = mysqli_query($conn, $insert_comm);

if ($run_query) {
    echo 'Comment Successfully...';
} else {
    echo 'Failed!!!';
}

?>