<?php

require '../include/connection.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../pages/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Menu Bar</title>
        <style type="text/css">
            .menuBar {
                background-color: #ccc;
            }
            .menuBar .container .row .menu-bar {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        </style>
    </head>
    <body>

        <!-- Manu Bar -->
        <div class="container-fluid menuBar">
        <div class="container p-2 mt-1 mb-2">
            <div class="row">

                <div class="col-lg-12 menu-bar">
                    <div class="left-bar">
                        <form>
                        <?php
                            $userid = $_SESSION['id'];

                            $get_user_role = "SELECT * FROM register WHERE id='{$userid}'";
                            $run_q = mysqli_query($conn, $get_user_role);
                            $get_arr = mysqli_fetch_array($run_q);

                            if ($get_arr['user_role'] == 'user') {
                                echo '
                                    <button class="btn btn-secondary"><a href="./all_post.php" style="text-decoration: none;color: #fff;">HOME</a></button>
                                    <button class="btn btn-warning"><a href="./user_edit.php" style="text-decoration: none;color: #fff;">EDIT PROFILE</a></button>
                                    <button class="btn btn-dark"><a href="./post.php" style="text-decoration: none;color: #fff;">ADD NEW POST</a></button>
                                    <button class="btn btn-primary"><a href="./shop.php" style="text-decoration: none;color: #fff;">SHOP</a></button>
                                    <button class="btn btn-success"><a href="./user_data.php" style="text-decoration: none;color: #fff;">AJAX USER DATA</a></button>
                                ';
                            } else {
                                echo '
                                    <h4 class="text-primary" style="display: inline;">' . $get_arr['username'] . ' <span style="color:#fff;background-color: #000;border-radius: 20px;font-size: 10px;" class="p-1">ADMIN</span></h4>
                                    <button class="btn btn-warning ms-3"><a href="./add_product.php" style="text-decoration: none;color: #fff;">Add Product</a></button>
                                ';
                            }
                        ?>
                        </form>
                    </div>
                    <div class="right-bar">

                        <?php
                        
                            $userID = $_SESSION['id'];
                            $select_user = "SELECT * FROM register WHERE id='{$userID}'";
                            $run_query = mysqli_query($conn, $select_user);
                            $fetch_array = mysqli_fetch_array($run_query);

                            if ($fetch_array['user_role'] == 'user') {
                                echo '
                                    <h4 class="text-primary">' . $fetch_array['username'] . '</h4>
                                    <form>
                                        <button class="btn btn-danger"><a href="../php/logout.php" style="text-decoration: none;color: #fff;">LOGOUT</a></button>
                                        <button class="btn btn-primary"><a href="./reset_password.php" style="text-decoration: none;color: #fff;">RESET PASSWORD</a></button>
                                    </form>
                                ';
                            } else {
                                echo '
                                    <form>
                                        <button class="btn btn-primary"><a href="./reset_password.php" style="text-decoration: none;color: #fff;">Reset Password</a></button>
                                        <button class="btn btn-danger"><a href="../php/logout.php" style="text-decoration: none;color: #fff;">Logout</a></button>
                                    </form>
                                ';
                            }
                        
                        ?>

                    </div>
                </div>

            </div>
        </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
