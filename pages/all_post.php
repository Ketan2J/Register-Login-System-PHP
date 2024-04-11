<?php

require '../include/connection.php';

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ./login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>

        <!-- Menu Bar -->
        <?php include '../include/menubar.php'; ?>

        <div class="container">
            <div class="row">
                
                <div class="col-lg-12" id="a">
                    <h1 class="text-center" style="color:#30f;font-weight: 600;">Home Page</h1>
                </div>

                <div class="col-lg-12 mt-5 mb-3">
                    <button class="btn btn-primary" type="button" onclick="backFunc()">BACK</button>
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                getAllPosts();
            });

            function getAllPosts() {
                $.ajax({
                    cache: false,
                    type: 'GET',
                    url: './api/all_post.php',
                    contentType: "application/json",
                    mimeType : "json",
                    success: function (res) {
                        $.each(res, function(key, val) {
                            $("#a").after(
                                '<div class="col-lg-12">\
                                    <div class="m-2 border shadow p-2" style="border-radius: 20px;">\
                                        <div style="display: flex;justify-content: space-between;align-items: center;">\
                                            <h4 style="color: orange;">' + val['post_author'] + '</h4>\
                                            <span class="me-4" style="font-weight: 600;color: #000;">Date: ' + val['post_created_date'] + '</span>\
                                        </div>\
                                        <hr/>\
                                        <p style="font-size:20px;font-weight: 600;">' + val['post_title'] + '</p>\
                                        <div class="post-content" style="display: flex;justify-content: center;align-items: center;margin-bottom: 15px;">\
                                            <img src="../image/' + val['post_image'] + '" alt="post_img" onerror="this.src=`../image/default.jpg`" class="shadow border" style="border-radius: 10px;width:500px;height:400px;object-fit:cover;">\
                                        </div>\
                                        <p>' + val['post_desc'] + '</p>\
                                        <h4>Comments:</h4>\
                                        <form action="../php/insert_comment.php" method="POST" id="comment_form">\
                                            <div class="mb-3">\
                                                <input type="hidden" name="post-id" class="form-control" value="' + val['post_id'] + '">\
                                            </div>\
                                            <div class="mb-3">\
                                                <input type="text" name="newcomment" class="form-control" placeholder="Write Comment...">\
                                            </div>\
                                            <button class="btn btn-dark" type="submit">ADD</button>\
                                        </form>');
                                        $.each(val['comment_array'], function(key_1, val_1) {
                                            $("#comment_form").after(
                                                '<div class="comment-section mt-2 p-4">\
                                                    <div class="wrapper d-flex justify-content-between align-items-center">\
                                                        <h5 style="font-weight: 500;color: #000;">' + val_1['post_comment_user'] +'</h5>\
                                                        <span style="font-weight: 500;font-size: 14px;">Date: ' + val_1['post_comment_time'] + '</span>\
                                                    </div>\
                                                    <p>' + val_1['post_comments'] + '</p>\
                                                </div>\
                                            </div>\
                                        </div>'
                                            )
                                        })     
                            })
                        }
                    }
                )
            }

            function backFunc() {
                window.history.back();
            }

        </script>
    </body>
</html>
