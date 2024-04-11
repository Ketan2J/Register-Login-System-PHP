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
        <title>User Edit Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>

        <!-- Menu Bar -->
        <?php include '../include/menubar.php'; ?>

        <div class="container">
            <div class="row">

                <div class="col-lg-12 d-flex justify-content-center align-items-cetner">
                    <h1 class="text-primary">User Edit</h1>
                </div>

                <div class="col-lg-12">
                    <form action="./api/user_edit.php" method="GET">
                        <button class="btn btn-success" id="edit_form" name="update_btn" type="submit" onclick="updateUser()">SAVE</button>
                        <button class="btn btn-danger" type="button" onclick="backFunc()">CANCEL</button>
                    </form>
                </div>
            
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <script>

            $(document).ready(function(){
                getUserDetail()
            })

            function getUserDetail() {
                var form_id = document.getElementById('edit_form');
                $.ajax({
                    type: 'GET',
                    url: './api/user_edit_disp.php',
                    contentType: "application/json",
                    mimeType : "json",
                    success: function(res) {
                        $(form_id).before(
                            '<div class="mb-3">\
                                <label style="font-weight: 700;font-size:20px;">User Name</label>\
                                <input class="form-control" name="uName" type="text" placeholder="Update your new user name..." value="' + res['user_name'] + '">\
                            </div>\
                            <div class="mb-3">\
                                <label style="font-weight: 700;font-size:20px;">E-Mail Address</label>\
                                <input class="form-control" name="uEmail" type="email" placeholder="Update your new email address..." value="' + res['user_email'] + '">\
                            </div>\
                            <div class="mb-3">\
                                <label style="font-weight: 700;font-size:20px;">Mobile Number</label>\
                                <input class="form-control" name="mobileNumber" type="number" placeholder="Update your new mobile number..." value="' + res['user_mobile_no'] + '">\
                            </div>\
                            <div class="mb-3">\
                                <label style="font-weight: 700;font-size:20px;">City</label>\
                                <input class="form-control" name="uCity" type="text" placeholder="Update your new city..." value="' + res['user_city'] + '">\
                            </div>\
                            '
                        );
                    }
                })
            }

            function updateUser() {
                $.ajax({
                    type: 'GET',
                    url: './api/user_edit.php',
                    success: function(res) {
                        alert('Record was update successfully...')
                    }
                })
            }

            function backFunc() {
                window.history.back()
            }

        </script>
    </body>
</html>
