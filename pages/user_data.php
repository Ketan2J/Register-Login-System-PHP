<?php

require '../include/connection.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("Locaiton: ./login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax | User Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>City</th>
                            <th>User Role</th>
                        </tr>
                    </thead>
                    <tbody id="user_tbl"></tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $.ajax ({
                type: "POST",
                url: "userD.php",
                contentType: "application/json",
                dataType : "json", 
                success: function (res) {
                    $.each(res, function(key, value) {
                        $("#user_tbl").append('<tr>'+
                            '<td>'+value['username']+'</td>\
                            <td>'+value['email']+'</td>\
                            <td>'+value['mobileno']+'</td>\
                            <td>'+value['city']+'</td>\
                            <td>'+value['user_role']+'</td>\
                    </tr>');
                    })
                }
            })
        })

    </script>
</body>
</html>
