<?php

require '../include/connection.php';
session_start();

if(!isset($_SESSION['id'])) {
    header("Location: ./login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Post</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            label {
                font-size: 18px;
                font-weight: 600;
            }
        </style>
    </head>
    <body>
        
        <!-- Menu Bar -->
        <?php include '../include/menubar.php'; ?>

        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="text-center">Post Edit</h1>
                </div>

                <div class="col-lg-12 mb-3">
                    <form action="./api/update_post_api.php" method="GET" enctype="multipart/form-data">
                        <button class="btn btn-success" id="post_edit_btn" name="post-update" type="submit">UPDATE</button>
                        <button class="btn btn-warning" type="button" onclick="backFunc()">BACK</button>
                    </form>
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <script>

            function getParameterByName(name) {  
                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex.exec(location.search);
                return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
            }
            var postId = getParameterByName('post_id');

            console.log(postId)

            $(document).ready(function() {
                getPostInfo()
            })

            function getPostInfo() {
                var a = document.getElementById('post_edit_btn');
                $.ajax({
                    type: 'GET',
                    url: './api/post_edit_detail.php?post_id=' + postId,
                    contentType: "application/json",
                    mimeType : "json",
                    success: function (res) {
                        $(a).before(
                            '<div class="mb-3">\
                                <input type="hidden" name="post_ID" value="' + res['post_ID'] + '">\
                            </div>\
                            <div class="mb-3">\
                                <label>Post Title:</label>\
                                <input type="text" class="form-control" name="post-title" value="' + res['post_title'] + '" placeholder="Write new title...">\
                            </div>\
                            <div class="mb-3">\
                                <img src="../image/' + res['post_image'] + '" alt="post_img" onerror="this.src=`../image/default.jpg`" style="display: block;object-fit: cover;" width="400px" height="300px">\
                                <label>Post Image:</label>\
                                <input type="file" class="form-control" name="p_image" accept=".jpg, .jpeg, .png">\
                            </div>\
                            <div class="mb-3">\
                                <label>Post Description:</label>\
                                <textarea type="text" class="form-control" name="post-desc" rows="5" cols="30" placeholder="Write new title...">' + res['post_description'] + '</textarea>\
                            </div>\
                            '
                        )
                    }
                })
            }

            function updatePost() {
                $.ajax({
                    type: 'GET',
                    url: './api/update_post_api.php?=' + postId,
                    success: function (res) {
                        alert('Post Update.');
                    }
                })
            } 

            function backFunc() {
                window.history.back()
            }

        </script>
    </body>
</html>
