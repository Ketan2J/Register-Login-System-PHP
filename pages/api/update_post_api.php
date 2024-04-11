<?php

require '../../include/connection.php';
session_start();

$user_id = $_SESSION['id'];

$post_id = $_GET['post_ID'];
$post_title = $_GET['post-title'];
$post_img = $_GET['p_image'];
$post_description = $_GET['post-desc'];

$updatePOST = "UPDATE post SET title='{$post_id}', post_img='{$post_img}', description='{$post_description}' WHERE id='{$post_id}'";
$run_post_u = mysqli_query($conn, $updatePOST);

if ($run_post_u) {
    $response = json_encode(array('status' => '200'));
    echo json_encode($response);
    // header("Location: ../edit_post.php");
} else {
    echo "QUERY FAILED!";
}

?>
