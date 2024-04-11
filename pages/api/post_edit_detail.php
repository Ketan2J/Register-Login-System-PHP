<?php

require '../../include/connection.php';
session_start();

$getUserID = $_SESSION['id'];

$getPOST = $_GET['post_id'];

$select_post = "SELECT * FROM post WHERE id='{$getPOST}'";
$run_post = mysqli_query($conn, $select_post);
$get_post_rows = mysqli_num_rows($run_post);
$get_post_arr = mysqli_fetch_assoc($run_post);

$post_array = array(
    'post_ID' => $get_post_arr['id'],
    'post_title' => $get_post_arr['title'],
    'post_image' => $get_post_arr['post_img'],
    'post_description' => $get_post_arr['description']
);

echo json_encode($post_array);

?>
