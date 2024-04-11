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
        <title>User Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> 
    </head>
    <body>
        <!-- Menu Bar -->
        <?php include '../include/menubar.php'; ?>

        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="text-primary" style="text-align: center;">User</h1>
                    <table class="table" id="user_table">
                        <thead>
                            <tr>
                                <th width="90%">User Name</th>
                                <th width="10%">Make Friend</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_f">

                        </tbody>
                    </table>
                </div>

                <div class="col-lg-12 mt-5 p-2" style="background-color: #e5e5e5; border-radius: 20px;">
                    <h1 class="text-primary" style="text-align: center;">My Posts</h1>
                    <table class="table" id="post_table">
                        <thead>
                            <tr>
                                <td style="font-weight: 700;">POST ID</td>
                                <td style="font-weight: 700;">TITLE</td>
                                <td style="font-weight: 700;">DESCRIPTOIN</td>
                                <td style="font-weight: 700;">STATUS</td>
                                <td style="font-weight: 700;">CREATED TIME</td>
                                <td style="font-weight: 700;">UPDATED TIME</td>
                                <td style="font-weight: 700;">ACTION</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $user_id = $_SESSION['id'];
                                $select_post = "SELECT * FROM post WHERE user_id='{$user_id}'";
                                $run_q = mysqli_query($conn, $select_post);

                                if (mysqli_num_rows($run_q) > 0) {
                                    while ($count_row = mysqli_fetch_array($run_q)) {
                                        echo '
                                            <tr>
                                                <td>' . $count_row['id'] . '</td>
                                                <td>' . $count_row['title'] . '</td>
                                                <td>' . $count_row['description'] . '</td>
                                                <td>' . $count_row['status'] . '</td>
                                                <td>' . $count_row['create_time'] . '</td>
                                                <td>' . $count_row['update_time'] . '</td>';
                                        if ($count_row['status'] == 'pending' || $count_row['status'] == 'disapproved') {
                                            echo'
                                                <td>
                                                    <button class="btn btn-warning"><a href="./edit_post.php?post_id=' . $count_row['id'] . '" style="text-decoration: none;color: #000;">EDIT</a></button>
                                                </td>
                                            ';
                                        } else {
                                            echo'
                                                <td>
                                                    <button class="btn btn-warning" style="display: none;"><a href="./edit_post.php">EDIT</a></button>
                                                </td>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                        <tr>
                                            <td class="text-danger" style="font-weight:600;">No Post Uploaded!</td>
                                        </tr>
                                    ';
                                }
                            
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> 
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> 
        <script>
            $(document).ready(function(){

                $('#user_table').dataTable({
                    "ajax": './api/user.json',
                    "columns": [
                        { 'data': 'userName' },
                        { 'data': null,
                            orderable: false,
                            "mRender" : function ( data, type, row ) {
                            return '<button class="btn btn-primary">Add Friend</button>';
                            }
                        }
                    ]
                });

                $('#post_table').dataTable({
                    "ajax": './api/user_post.json',
                    "columns": [
                        { 'data': 'post_id' },
                        { 'data': 'post_title' },
                        { 'data': 'post_description' },
                        { 'data': 'post_status' },
                        { 'data': 'post_created_date' },
                        { 'data': 'post_update_date' },
                        { 'data': null,
                            orderable: false,
                            "mRender" : function ( data, type, row ) {
                                if (data.post_status == 'approved') {
                                    return '<a href="./edit_post.php" class="btn btn-warning" style="display:none;">EDIT</a>';
                                } else {
                                    return '<a href="./edit_post.php?post_id=' + data.post_id + '" class="btn btn-warning">EDIT</a>';
                                }
                            }
                        }
                    ]
                });
            });

        </script>
    </body>
</html>
