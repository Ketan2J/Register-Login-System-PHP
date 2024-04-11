<?php

require '../include/connection.php';
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ./login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Blog Post Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>

        <!-- Menu Bar -->
        <?php include '../include/menubar.php'; ?>

        <h1 class="text-center">POST</h1>

        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <form action="../php/post_upload.php" method="POST">
                        <div class="mb-3">
                            <label>Post Title</label>
                            <input type="text" name="post_title" class="form-control" placeholder="Write post title...">
                        </div>
                        <div class="mb-3">
                            <label>Post Image</label>
                            <input type="file" name="post_i" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label>Post Description</label>
                            <textarea type="text" name="post_description" rows="5" cols="30" class="form-control" placeholder="Write post description..."></textarea>
                        </div>
                        <button class="btn btn-success" type="submit">UPLOAD POST</button>
                        <button class="btn btn-warning" type="button" onclick="backFunc()">BACK</button>
                    </form>
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            function backFunc() {
                window.history.back()
            }
        </script>
    </body>
</html>
