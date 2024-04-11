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
        <title>Reset Password Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>

        <!-- Menu Bar -->
        <?php include '../include/menubar.php'; ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Reset Password</h1>
                    <form action="../php/reset_pwd.php" method="POST">
                        <div class="mb-3">
                            <label for="old_pass">Old Password</label>
                            <input type="text" name="old_pawd" class="form-control" placeholder="Enter Old Password..." required>
                        </div>
                        <div class="mb-3">
                            <label for="new_pass">New Password</label>
                            <input type="text" name="new_pawd" class="form-control" placeholder="Enter New Password..." required>
                        </div>
                        <button class="btn btn-success" name="reset_btn" type="submit">RESET</button>
                        <button class="btn btn-danger" onclick="backFunc()">CANCEL</button>
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
                        
