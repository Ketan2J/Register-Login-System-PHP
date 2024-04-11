<?php

require '../include/connection.php';
session_start();

if (isset($_POST['post-update'])) {
    $get_new_title = $_POST['post-title'];
    $get_new_description = $_POST['post-desc'];
    $get_new_post_image = $_POST["post_image"];
    
    if ($get_new_post_image != '') {

        $get_post_id = $_POST['post-id'];
        $get_old_img = "SELECT * FROM post WHERE id='{$get_post_id}'";
        $run_q = mysqli_query($conn, $get_old_img);
        $get_num =  mysqli_num_rows($run_q);
        if ($get_num > 0) {
            $count_row = mysqli_fetch_assoc($run_q);
            $post_IMG = $count_row['post_img'];
            unlink('../image/' . $post_IMG);
        }

        $update_time = date('Y-m-d H:i:s');

        $filename = $_FILES['post_image']['name'];
        $tempname = $_FILES['post_image']['tmp_name'];
        $folder = "../image/" . $filename;

        if (move_uploaded_file($tempname, $folder)) {
            $update_post = "UPDATE post SET title='{$get_new_title}', post_img='{$get_new_post_image}', description='{$get_new_description}', update_time='{$update_time}' WHERE id='{$get_post_id}'";
            $run_query = mysqli_query($conn, $update_post);
            if($run_query) {
                echo 'Post Updated Successfully!';
            }
        } else {
            echo "<h3>Failed to upload image!</h3>";
        }
    } else {
        $get_post_id = $_GET['post-id'];
        $update_time = date('Y-m-d H:i:s');
        $update_post = "UPDATE post SET title='{$get_new_title}', description='{$get_new_description}', update_time='{$update_time}' WHERE id='{$get_post_id}'";
        $run_query = mysqli_query($conn, $update_post);
        if($run_query) {
            echo 'Post Updated Successfully!';
        }
    }
}

?>
