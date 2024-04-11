<?php

require '../include/connection.php';
session_start();

$user_id = $_SESSION['id'];
$post_title = $_POST['post_title'];
$post_image = $_POST['post_i'];
$post_description = $_POST['post_description'];
$post_status = 'pending';
$create_time = date('Y-m-d H:i:s');
$update_time = date('Y-m-d H:i:s');

$filename = $_FILES['post_i']['name'];
$tempname = $_FILES['post_i']['tmp_name'];
$folder = "../image/" . $filename;

if (move_uploaded_file($tempname, $folder)) {
    echo "<h3>  Image uploaded successfully!</h3>";
} else {
    echo "<h3>  Failed to upload image!</h3>";
}

$insert_query = "INSERT INTO post(title, post_img, description, user_id, status, create_time, update_time) VALUES('$post_title', '$post_image', '$post_description', '$user_id', '$post_status', '$create_time', '$update_time')";
$run_query = mysqli_query($conn, $insert_query);

if (!$run_query) {
    echo 'Post not upload! ERROR!';
} else {
    $postUpload = 'Post Successfully Uploaded!';
    header("Location: ../pages/user_profile.php?postUpload=$postUpload");
}

?>
