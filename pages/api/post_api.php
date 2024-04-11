<?php

require '../../include/connection.php';
session_start();

$get_user_id = $_SESSION['id'];

$select_post = "SELECT * FROM post";
$run_post = mysqli_query($conn, $select_post);
$get_post_rows = mysqli_num_rows($run_post);

$post_arr = array();
$user_post_arr = array();

if ($get_post_rows > 0) {
    while ($ar_post = mysqli_fetch_assoc($run_post)) {

        $author_id = $ar_post['user_id'];
        $get_author = "SELECT * FROM register WHERE id='{$author_id}'";
        $run_a = mysqli_query($conn, $get_author);
        $get_a_arr = mysqli_fetch_assoc($run_a);

        $post_arr[] = array(
            'post_id' => $ar_post['id'],
            'post_author' => $get_a_arr['username'],
            'post_title' => $ar_post['title'],
            'post_img' => $ar_post['post_img'],
            'post_description' => $ar_post['description'],
            'post_status' => $ar_post['status'],
            'post_created_date' => $ar_post['create_time'],
            'post_update_date' => $ar_post['update_time'],
        );

        if ($get_user_id == $get_a_arr['id']) {
            $user_post_arr[] = array(
                'post_id' => $ar_post['id'],
                'post_title' => $ar_post['title'],
                'post_description' => $ar_post['description'],
                'post_status' => $ar_post['status'],
                'post_created_date' => $ar_post['create_time'],
                'post_update_date' => $ar_post['update_time'],
            );
        } else {
            $user_post_arr[] = array();
        }

    }

    $fp_ = fopen('post.json', 'w');
    fwrite($fp_, json_encode($post_arr));
    fclose($fp_);

    $fp_1 = fopen('user_post.json', 'w');
    fwrite($fp_1, json_encode($user_post_arr));
    fclose($fp_1);

    echo json_encode($user_post_arr);
    echo json_encode($post_arr);
}

?>
