<?php

require '../../include/connection.php';
session_start();

$get_posts = "SELECT * FROM post WHERE status='approved'";
$run_q = mysqli_query($conn, $get_posts);
$posts_rows = mysqli_num_rows($run_q);

$post_array = array();
$comment_array = array();

if ($posts_rows > 0) {
    while ($get_POSTS = mysqli_fetch_array($run_q)) {

        $author_id = $get_POSTS['user_id'];
        $get_author = "SELECT * FROM register WHERE id='{$author_id}'";
        $run_au = mysqli_query($conn, $get_author);
        $au_arr = mysqli_fetch_array($run_au);

        $get_postID = $get_POSTS['id'];
        $get_comments = "SELECT * FROM comment WHERE post_id='{$get_postID}'";
        $run_com = mysqli_query($conn, $get_comments);
        $get_comment_rows = mysqli_num_rows($run_com);

        while ($get_comm_arr = mysqli_fetch_array($run_com)) {

            $get_com_u_id = $get_comm_arr['user_id'];
            $getComment_name = "SELECT * FROM register WHERE id='{$get_com_u_id}'";
            $run_u_comment = mysqli_query($conn, $getComment_name);
            $get_u_comment_arr = mysqli_fetch_array($run_u_comment);

            $comment_array[] = array(
                'post_comment_user' => $get_u_comment_arr['username'],
                'post_comments' => $get_comm_arr['comment'],
                'post_comment_time' => $get_comm_arr['date_t']   
            );
        }

        $post_array[] = array(
            'post_id' => $get_POSTS['id'],
             'post_author' => $au_arr['username'], 
             'post_title' => $get_POSTS['title'], 
             'post_created_date' => $get_POSTS['create_time'],
             'post_image' => $get_POSTS['post_img'],
             'post_desc' => $get_POSTS['description'],
             'comment_array' => $comment_array
        );

    }
    echo json_encode($post_array);
}

?>
