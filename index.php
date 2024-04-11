<?php

require './include/connection.php';
session_start();

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $get_user_role = "SELECT * FROM register WHERE id='{$user_id}'";
    $run_q = mysqli_query($conn, $get_user_role);
    $fetch_arr = mysqli_fetch_array($run_q);
    
    if(isset($_SESSION['id'])) {
        if ($fetch_arr['user_role'] == 'admin') {
            header("Location: ./pages/user_records.php");
        } else {
            header("Location: ./pages/user_profile.php");
        }
    } else {
        header('Location: ./index.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Log In System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Register</h1>
                    <form action="./pages/api/register_api.php" method="GET">
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="uname" class="form-control" placeholder="Enter Your Name..." required>
                        </div>
                        <div class="mb-3">
                            <label for="mobileno">Mobile No.</label>
                            <input type="number" name="mobile_no" class="form-control" placeholder="Enter Your Mobile Number..." required>
                        </div>
                        <div class="mb-3">
                            <label for="usernam">E-Mail Address</label>
                            <input type="email" name="email_address" class="form-control" placeholder="Enter Your E-Mail Address..." required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Create Password..." required>
                        </div>
                        <div class="mb-3">
                            <label for="city">City</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter Your City..." required>
                        </div>
                        <div class="mb-3">
                            <label for="userrole">Select Your User Role</label>
                            <select class="form-select" name="user_Role" aria-label="Default select example">
                                <option value="user" selected>User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button class="btn btn-success" onclick="registerFunc()" type="submit">REGISTER</button>
                        <button class="btn btn-warning"><a href="./pages/login.php" style="text-decoration: none;color: #000;">Already have an account?</a></button>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>

            function registerFunc() {
                $.ajax({
                    type: 'POST',
                    url: "./api/register_api.php",
                    contentType: "application/json",
                    dataType : "json",
                    success: function (res) {
                        alert('New account created successfuly...');
                    }
                })
            }

        </script>
    </body>
</html>
