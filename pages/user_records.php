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
        <title>User Records</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> 
    </head>
    <body>

        <!-- Menu Bar -->
        <?php include '../include/menubar.php'; ?>

        <div class="container">
            <div class="row">
            
                <h1 class="text-center" style="color: orange;">User Records</h1>
                
                <div class="col-lg-12">
                    <table class="table" id="user_records">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <th>E-Mail Address</th>
                                <th>City</th>
                                <th>User Role</th>
                                <th>EDIT</th>
                            </tr>
                        </thead>
                        <tbody id="table_1_user">

                        </tbody>
                    </table>
                </div>

                <div class="col-lg-12 mt-2" style="background-color: #e5e5e5;border-radius: 20px;">
                    <h1 class="text-center" style="color: orange;">Posts</h1>
                    <table class="table" id="post_table">
                        <thead>
                            <tr>
                                <td style="font-weight: 700;">Index</td>
                                <td style="font-weight: 700;">Author Name</td>
                                <td style="font-weight: 700;">Post Title</td>
                                <td style="font-weight: 700;">Post Image</td>
                                <td style="font-weight: 700;">Post Description</td>
                                <td style="font-weight: 700;">Post Status</td>
                                <td style="font-weight: 700;">Post Upload Date/Time</td>
                                <td style="font-weight: 700;">Post Update Date/Time</td>
                                <td style="font-weight: 700;">Post Aprroved</td>
                                <td style="font-weight: 700;">Post Disaprroved</td>
                            </tr>
                        </thead>
                        <tbody style="background-color: #e5e5e5;" id="table_1_post">

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
                $('#user_records').dataTable({
                    "ajax": './api/udata.json',
                    "columns": [
                        { 'data': 'user_id' },
                        { 'data': 'userName' },
                        { 'data': 'mobilenumber' },
                        { 'data': 'emailAdd' },
                        { 'data': 'address' },
                        { 'data': 'userrole' },
                        { 'data': null,
                            orderable: false,
                            "mRender" : function ( data, type, row ) {
                            return '<a href="./admin_edit.php?user_ID=' + data.user_id + '" class="btn btn-success">EDIT</a>';
                            }
                        }
                    ]
                });

                $('#post_table').dataTable({
                    "ajax": './api/post.json',
                    "columns": [
                        { 'data': 'post_id' },
                        { 'data': 'post_author' },
                        { 'data': 'post_title' },
                        { 'data': null,
                            orderable: false,
                            "mRender" : function ( data, type, row ) {
                                if (data.post_img == '') {
                                    return null;
                                } else {
                                    return data.post_img = 'post_img'
                                }
                            }
                        },
                        { 'data': 'post_description' },
                        { 'data': 'post_status' },
                        { 'data': 'post_created_date' },
                        { 'data': 'post_update_date' },
                        { 'data': null,
                            orderable: false,
                            "mRender" : function ( data, type, row ) {
                                if ( data.post_status == 'approved' || data.post_status == 'disapproved' ) {
                                    return '<a href="../php/post_approved.php?post_id=' + data.post_id + '" class="btn btn-success" style="display:none;">APPROVED</a>';
                                } else {
                                    return '<a href="../php/post_approved.php?post_id=' + data.post_id + '" class="btn btn-success">APPROVED</a>';
                                }
                            }
                        },
                        { 'data': null,
                            orderable: false,
                            "mRender" : function ( data, type, row ) {
                                if ( data.post_status == 'disapproved' || data.post_status == 'approved' ) {
                                    return '<a href="../php/post_dis_approved.php?post_id=' + data.post_id + '" class="btn btn-danger" style="display:none;">DISAPPROVED</a>';
                                } else {
                                    return '<a href="../php/post_dis_approved.php?post_id=' + data.post_id + '" class="btn btn-danger">DISAPPROVED</a>';
                                }
                            }
                        }
                    ]
                });

            });

        </script>
    </body>
</html>
