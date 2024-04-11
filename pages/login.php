<?php 

require_once '../include/connection.php';
session_start();

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    echo $user_id;
    $get_user_role = "SELECT * FROM register WHERE id='{$user_id}'";
    $run_q = mysqli_query($conn, $get_user_role);
    $fetch_arr = mysqli_fetch_array($run_q);
    
    if(isset($_SESSION['id'])) {
        if ($fetch_arr['user_role'] == 'user') {
            header("Location: ./user_profile.php");
        } else {
            header("Location: ./user_records.php");
        }
    } else {
        header("Location: ./login.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Log In Account</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Log In</h1>
                    <form action="./api/login_api.php" method="GET">
                        <div class="mb-3">
                            <label for="username">E-Mail Address</label>
                            <input type="email" id="email_add" name="email_address" class="form-control" placeholder="Enter Your E-Mail Address..." required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="pass" class="form-control" placeholder="Create Password..." required>
                        </div>
                        <button class="btn btn-warning" id="loginBTN" onclick="logInFunc()" name="login_btn">LOG IN</button>
                        <button class="btn btn-success"><a href="../index.php" style="text-decoration: none;color:#fff;">Create new one?</a></button>
                        <?php

                            if (isset($_SESSION['error'])) {
                                $err = $_SESSION['error'];
                                echo '<p>' . $err . '</p>';
                                unset($_SESSION['error']);
                            }

                        ?>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>

            function logInFunc() {

                $.ajax({
                    type: "GET",
                    url: "./api/login_api.php",
                    contentType: "application/json",
                    dataType : "json",
                    success: function (res) {
                        if (res['user_role'] == 'user') {
                            window.location.href = "./user_profile.php";
                        } else if (res['user_role'] == 'admin'){
                            window.location.href = "./user_records.php";
                        }
                    }
                })
            }

        </script>
    </body>
</html>
